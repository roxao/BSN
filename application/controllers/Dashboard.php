<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {
// public $messagess = array();

	var $params = null;
    var $subparams = null;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('admin_model');
		$this->load->library('email');
		$this->load->helper('form'); 
		$this->load->database();
		$this->model = $this->admin_model;
	}

	public function index(){
		// $this->session_login();
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications()->result();
        $this->load->view('admin/inbox', $data);
    }

    public function registered_iin(){
		// $this->session_login();
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications()->result();
        $this->load->view('admin/registered_iin', $data);
    }

     public function report(){
		// $this->session_login();
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications()->result_array();
        $this->load->view('admin/report', $data);
    }

	public function user($subparams = null) {
		switch ($subparams) {
			case 'login':
		        $this->load->view('admin/login');
				break;
			case 'register':
				$this->load->view('admin/register');
				break;
			case null:
				$this->load->view('admin/login');
				break;
		}
	}


	public function get_app_data() {	
		// $this->session_login();
		$id = $this->input->post('getid');
		$step = $this->input->post('getstep');
		if($id!=null){
			switch ($step) {
				case 'verif_new_req':
					$data['application'] = $this->admin_model->get_application($id)->result()[0];
					echo json_encode($data);
					break;
				case 'verif_upldoc_req':
					$data['application'] = $this->admin_model->get_application($id)->result()[0];
					$data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
			        echo json_encode($data);
					break;
				case 'verif_revdoc_req':
					$data['application'] = $this->admin_model->get_application($id)->result()[0];
					$data['revdoc_user'] = $this->admin_model->get_doc_user($id)->result();
			        echo json_encode($data);
					break; 	
				case 'upl_bill_req':
					$data['application'] = $this->admin_model->get_application($id)->result()[0];
			        echo json_encode($data);
					break; 	
				case 'reupl_bill_req':
					$data['application'] = $this->admin_model->get_application($id)->result()[0];
			        echo json_encode($data);
					break; 	
				case 'verif_pay_req':
					$data['application'] = $this->admin_model->get_application($id)->result()[0];
					$data['doc_pay'] = $this->admin_model->get_doc_user($id)->result();
					$data['assessment_list'] = $this->admin_model->get_assessment()->result();
					$data['assessment_roles'] = $this->admin_model->get_doc_user($id)->result();
			        echo json_encode($data);
			        break;
			    case 'verif_rev_pay_req':
					$data['assessment_list'] = $this->admin_model->get_assessment()->result();
			        echo json_encode($data);    
			        break;
		       	case 'rev_assess_req':
		       		$data['assessment_list'] = $this->admin_model->get_assessment()->result();
			        echo json_encode($data);
					break; 	
				case 'field_assess_req':
			        echo json_encode($data);break; 	
			    case 'upl_res_assess_req':
			        echo json_encode($data);
			    case 'verif_rev_assess_res_req':
			        echo json_encode($data);break; 	
			    case 'cra_approval_req':
			        echo json_encode($data);break; 	
		        case 'upl_iin_doc_req':
			        echo json_encode($data);break; 	
			}
		}
	}

	private function session_login(){
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) redirect(base_url('dashboard/user/login'));
        return false;
	}

	public function set_view($param = null, $subparams = null) {
		$this->load->view('admin/'.$param.'/'.$subparams);
	}


	function do_upload() {
		$this->load->library('upload');
		$this->upload->initialize(array("allowed_types" => "gif|jpg|png|jpeg|pdf|doc", "upload_path" => "./upload/"));
		//Perform upload.
		if($this->upload->do_upload("images")) {
			echo '<script>console.log('.var_export($this->upload->data()).');</script>';

			$admin_name		= 'Rinaldy Sam';
			$doc_step 		= 'verif_upldoc_req';
			$doc_step_name 	= 'Verifikasi Kelengkapan Dokumen';
			/*Insert Log document Revisi*/
			write_log($admin_name, $doc_step, 'do upload documents');
			$upload_data = array(
                'id_application '=> $get_documen->row->id_application,
                'id_application_status_name' => $doc_step,
                'process_status' => 'PENDING',
                'approval_date' => 'null',
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'last_updated_date' => date('Y-m-j'));
            $this->admin_model->insert_app_status($upload_data);
        } else {
  			die('GAGAL UPLOAD');
      }
    }



}
