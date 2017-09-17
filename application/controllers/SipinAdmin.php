<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SipinAdmin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	    $this->load->helper(array('captcha','url','form'));
		$this->load->model('admin_model');
		$this->load->library('email');
		$this->load->helper('form'); 
		$this->load->database();
		$this->model = $this->admin_model;
	}

	public function index(){
		
        $this->load->view('admin/header_admin');

	}

	public function login_admin() {
		$this->load->view('admin/login_admin');
	}

	public function proses_login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->admin_model->cek_login($username,$password);
		
		echo $cek->num_rows();
		if($cek->num_rows() > 0){
			if ($cek->row()->admin_status == 0){ 
			 	$this->session->set_flashdata('falidasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');
			 	echo "gagal dari status";
			} else {
			 	if($cek->row()->admin_role == 0) {
			 		$this->session->set_flashdata('falidasi-login', 'Selamat Datang Supper Admin');
			 		// masuk ke tampilan super admin
			 		 $this->session->set_userdata(array(
				    'id_admin'  	=> $cek->row()->id_admin,
				    'username' 		=> $cek->row()->username,
				    'email'  		=> $cek->row()->email,
				    'admin_status' 	=> $cek->row()->admin_status,
			 		'admin_role' 	=> $cek->row()->admin_role));
			 		// ke index super admin 
			 		$this->load->view('admin/header_admin');
					$this->load->view('admin/admin_inbox');
			 	} else {
			 		echo "Selamat Datang Admin";
			 		$this->session->set_flashdata('falidasi-login', 'Selamat Datang admin');
     				 // masuk ke tampilan admin
				    $this->session->set_userdata(array(
				    'id_admin'  	=> $cek->row()->id_admin,
				    'username' 		=> $cek->row()->username,
				    'email'  		=> $cek->row()->email,
				    'admin_status' 	=> $cek->row()->admin_status,
			 		'admin_role' 	=> $cek->row()->admin_role));
				      // ke index admin 
			    	//$this->index();
			    	$this->load->view('admin/header_admin');
					$this->load->view('content_admin');
			 	}
			}
		}
		else{
			site_url('login_admin');
		}
	}

	public function session()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) redirect(site_url('login_admin'));
	}

	public function logout_admin(){	
		$this->session->sess_destroy();
		$data['logout'] = 'You have been logged out.';		
		$this->login_admin();
	}

	public function get_admin()
	{
		$data['data_admin'] = $this->admin_model->get_admin()->result();
		$this->load->view('admin/all_data_admin', $data);

	}

	public function insert_admin() {

	 	$this->load->view('admin/super_admin_insert_admin');
	 }
	 public function insert_admin_proses(){
   

        if($this->input->post('insert') == "insert") {
        	$data = array(
        		'email' => $this->input->post('email'),
        		'username' => $this->input->post('username'),
        		'password' => $this->input->post('password'),
        		'admin_status' => $this->input->post('admin_status'),
        		'admin_role' => $this->input->post('admin_role'),
        		'created_date' => date('Y-m-j H:i:s'),
        		// 'created_by' => $this->session->userdata('username')        		
        		);
        	$dataL = array(
        		'detail_log' => $this->session->userdata('admin_role').' adding new admin',
        		'log_type' => 'added '.$this->input->post('username'), 
        		'created_date' => date('Y-m-j H:i:s')
        		// 'created_by' => $this->session->userdata('username')
        		);
        	$this->admin_model->insert_log($dataL);
        	$this->admin_model->insert_admin($data);
        	echo "Data admin Berhasil tersimpan";
        }else {
        	echo "gagal disimpan";
        }    
    }

    public function insert_tim_asesment() {

     	$this->load->view('admin/super_admin_insert_asesment');
     }

    public function insert_tim_asesment_proses() {


		if($this->input->post('insert') == "insert"){
        	$name = array('name' => $this->input->post('name'));
			$title = array('title' => $this->input->post('title'));


        	$this->admin_model->insert_asesment($name,$title);
        	echo "Data Tim Asesment Berhasil tersimpan";
        }else {
        	echo "gagal disimpan";
        }
     }

    public function read_tim_asesment() {


		$data['data_asesment']    = $this->admin_model->read_asesment()->result();
		$this->load->view('admin/data_asesment', $data);
     }

     public function read_user(){


        $data['data_user'] = $this->admin_model->read_user()->result();
        $this->load->view('admin/data_user',$data);
     }

      public function read_applications(){

        $data['applications'] = $this->admin_model->get_applications_tes2()->result();
        $this->load->view('admin/inbox',$data);
     }

     public function edit_aplication($id_application) {

        $data['aplication'] = $this->admin_model->get_aplication($id_application)->result();
        $this->load->view('admin/inbox_edit', $data);
     }

	public function edit_aplication_proses(){

       if($this->input->post('update') == "update"){
        	$data = array(
        		'applicant' => $this->input->post('applicant'),
        		'instance_name' => $this->input->post('instance_name'),
        		'id_admin' => $this->session->userdata('id_admin'),
        		'last_updated_date' => date('Y-m-j H:i:s')
        		);
        	$condition = array('id_application' => $this->input->post('id_application'));
        	$this->admin_model->update_aplications($data,$condition);
        	echo "Data admin Berhasil tersimpan";
			header("refresh:0; inbox");
        } else {
        	echo "gagal disimpan";
        }
     }


     public function read_applications2(){

        $cek = $this->admin_model->get_applications2();
        
        // if ($cek->row()->id_application_status_name == 2) 
        if ($cek->num_rows() > 1) {
        	$data['applications'] = $this->admin_model->get_applications()->result();

        	$this->load->view('admin/inbox',$data);
        }else{
        	$data['applications'] = $this->admin_model->get_applications2()->result();

        	$this->load->view('admin/inbox',$data);
        }

     }

     public function get_document_config()
     {
     	$data['document'] = $this->admin_model->get_document()->result();
     	echo json_encode($data);
     }

     public function document_config_edit($id)
     {
     	$data['document'] = $this->admin_model->get_document_by_prm($id)->result();
     	echo json_encode($data);
     }

     public function edit_document_config_proses()
     {
     	$data = array(
     		'id_document_config' => $this->input->post('id_document_config'),
     		'key' => $this->input->post('key'),
     		'display_name' => $this->input->post('display_name'),
     		'file_url' => $this->input->post('file_url'),
     		'modified_by' => $this->input->post('file_url'),
     		'modified_date' => $this->input->post('modified_date')
     		);
     	$condition= array('id_document_config' => $this->input->post('id_document_config'));
     	
     		$dataL = array(
        		'detail_log' => $this->session->userdata('admin_role').' update document',
        		'log_type' => 'added '.$this->input->post('username'), 
        		'created_date' => date('Y-m-j H:i:s')
        		// 'created_by' => $this->session->userdata('username')
        		);
        	$this->admin_model->insert_log($dataL);
     	$this->admin_model->update_documenet_config($condition,$data);
     }

     public function get_survey()
     {
     	$data['survey'] = $this->admin_model->question_survey_question();
     	// echo json_encode($database);
     	$this->load->view('survey');
     }

     public function get_iin_data()
     {
     	$data['iin'] = $this->admin_model->get_iin()->result();
     	echo json_encode($data);
     }

     public function edit_iin($id)
     {
     	$data['iin'] = $this->admin_model->get_iin_by_prm($id)->result();
     	echo json_encode($data);
     }

     public function edit_iin_proses()
     {
     	$data = array(
     		
     		'id_user' => $this->input->post('id_user'),
     		'iin_established_date' => $this->input->post('iin_established_date'),
     		'iin_expiry_date' => $this->input->post('iin_expiry_date'),
     		'last_updated_date' => $this->input->post('last_updated_date')
     		// 'modified_by' => $this->session->userdata('username')
     		);

     	$condition = array('id_iin' => $this->input->post('id_iin'));

     	$dataL = array(
        		'detail_log' => $this->session->userdata('admin_role').' update iin',
        		'log_type' => 'added '.$this->input->post('username'), 
        		'created_date' => date('Y-m-j H:i:s')
        		// 'created_by' => $this->session->userdata('username')
        		);
        	$this->admin_model->insert_log($dataL);
     	$this->admin_model->update_iin($condition,$data);

     }

     public function get_data_cms()
     {
     	$data['cms'] = $this->admin_model->get_cms()->result();
     	echo json_encode($data);
     }

     public function edit_data_cms($id)
     {
     	$data['cms'] = $this->admin_model->get_cms_by_prm($id)->result();
     	echo json_encode($data);
     }

     public function edit_proses_cms()
     {
     	$data = array(
     		
     		'content' => $this->input->post('content'),
     		'content_name' => $this->input->post('content_name'),
     		'content_url' => $this->input->post('content_url'),
     		'content_type' => $this->input->post('content_type'),
     		'last_updated_date' => $this->date('y-m-d'),
     		// 'modified_by' => $this->session->userdata('username')
     		);
     	$condition = array('id_cms' => $this->input->post('id_cms'));

     	$dataL = array(
        		'detail_log' => $this->session->userdata('admin_role').' update cms',
        		'log_type' => 'added '.$this->input->post('username'), 
        		'created_date' => date('Y-m-j H:i:s')
        		// 'created_by' => $this->session->userdata('username')
        		);
        	$this->admin_model->insert_log($dataL);
     	$this->admin_model->update_cms($condition,$data);

     }

     public function get_complain_data()
     {
     	$data['compalin'] = $this->admin_model->get_conplain()->result();
     	echo json_encode($data);
     }

     public function get_data_user()
     {
     	$data['user'] = $this->admin_model->get_user()->result();
     	echo json_encode($data);
     }

     public function edit_data_user($id)
     {
     	$data['user'] = $this->admin_model->get_user_by_prm($id)->result();
     	echo json_encode($data);
     }

     public function edit_proses_user()
     {
     	$data = array(
     		'email' => $this->input->post('email'),
     		'username' => $this->input->post('username'),
     		'password' => $this->input->post('password'),
     		'name' => $this->input->post('name'),
     		'status_user' => $this->input->post('status_user'),
     		'survey_status' => $this->input->post('survey_status'),
     		'last_update_date' => $this->input->post('last_update_date')
     		// 'modified_by' => $this->session->userdata('name'),
     		);

     	$condition = array('id_user' => $this->input->post('id_user'));

     	$dataL = array(
        		'detail_log' => $this->session->userdata('admin_role').' update user',
        		'log_type' => 'added '.$this->input->post('username'), 
        		'created_date' => date('Y-m-j H:i:s')
        		// 'created_by' => $this->session->userdata('username')
        		);
        	$this->admin_model->insert_log($dataL);
     	$this->admin_model->update_user($condition,$data);
     }
 }
