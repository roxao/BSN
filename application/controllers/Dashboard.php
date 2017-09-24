<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$data['title_box'] = $this->input->post('status'); 
		if($id!=null){
			switch ($this->input->post('getstep')) {
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
					$data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
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
					// $data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
					$data['assessment_list'] = $this->admin_model->get_assessment()->result();
			        echo json_encode($data);
		       	case 'rev_assess_req':
		       		$data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
		       		$data['assessment_list'] = $this->admin_model->get_assessment()->result();
			        echo json_encode($data);
					break; 	
				case 'field_assess_req':
			        echo json_encode($data);
			    case 'upl_res_assess_req':
			        echo json_encode($data);
			    case 'verif_rev_assess_res_req':
			        echo json_encode($data);
			    case 'cra_approval_req':
			        echo json_encode($data);
		        case 'upl_iin_doc_req':
			        echo json_encode($data);
				case null:
					$this->load->view('admin/login');
					break;
			}
		}
	}

	private function session_login(){
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) redirect(base_url('dashboard/user/login'));
        return false;
	}


	public function approval($subparams = null) {
		$this->load->view('admin/approval/'.$subparams);
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

	// public function do_upload(){
	// 	$config = array(
	// 	'upload_path' => "./uploads/",
	// 	'allowed_types' => "gif|jpg|png|jpeg|pdf",
	// 	'overwrite' => TRUE,
	// 	'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
	// 	'max_height' => "768",
	// 	'max_width' => "1024"
	// 	);
	// 	$this->load->library('upload', $config);
	// 	if($this->upload->do_upload()){
	// 		$data = array('upload_data' => $this->upload->data());
	// 		$this->load->view('upload_success',$data);
	// 	}else{
	// 		$error = array('error' => $this->upload->display_errors());
	// 		$this->load->view('custom_view', $error);
	// 	}
	// }

 //   function write_log($creator, $step, $title){
 //   		$dataLog = array(
 //            'detail_log' 	=> 'Admin ' . $title,
 //            'log_type' 		=> 'Admin', 
 //            'description' 	=> 'Admin'. $creator . ' upload document in '. $step,
 //            'created_by'	=> $creater,
 //            'created_date' 	=> date('Y-m-j H:i:s')
 //        );
	//  	$this->admin_model->insert_log($dataLog);
 //   }


}
