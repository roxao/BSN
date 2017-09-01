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
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) redirect(site_url('proses_login_admin'));
        $this->load->view('header_admin');
		$this->load->view('content_admin');
	}

	public function login_admin() {
		$this->load->view('login_admin');
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
				    'admin_status' 	=> $cek->row()->admin_status));
			 		// ke index super admin 
			 		 $this->load->view('header_admin');
					$this->load->view('content_admin');
			 	} else {
			 		echo "Selamat Datang Admin";
			 		$this->session->set_flashdata('falidasi-login', 'Selamat Datang admin');
     				 // masuk ke tampilan admin
				    $this->session->set_userdata(array(
				    'id_admin'  	=> $cek->row()->id_admin,
				    'username' 		=> $cek->row()->username,
				    'email'  		=> $cek->row()->email,
				    'admin_status' 	=> $cek->row()->admin_status));
				      // ke index admin 
			    	//$this->index();
			    	$this->load->view('header_admin');
					$this->load->view('content_admin');
			 	}
			}
		}
		else{
			//redirect(site_url('login'));
		}
	}


	public function logout_admin(){	
		$this->session->sess_destroy();
		$data['logout'] = 'You have been logged out.';		
		$this->login_admin();
	}

	public function tambah_admin() {
	 	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) {
            redirect(site_url('proses_login_admin'));
        }
	 	$this->load->view('super_admin_insert_admin');
	 }
	 public function tambah_admin_proses(){
        $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) {
            redirect(site_url('proses_login_admin'));
        }

        if($this->input->post('insert') == "insert") {
        	$data = array(
        		'email' => $this->input->post('email'),
        		'username' => $this->input->post('username'),
        		'password' => $this->input->post('password'),
        		'admin_status' => $this->input->post('admin_status'),
        		'admin_role' => $this->input->post('admin_role'),
        		'created_date' => date('Y-m-j H:i:s'),
        		'created_by' => $this->session->userdata('username'),
        		'last_update_date' => date('Y-m-j H:i:s'),
        		'modified_by' => $this->input->post('username')
        		);
        	$this->admin_model->insert_admin($data);
        	echo "Data admin Berhasil tersimpan";
        }else {
        	echo "gagal disimpan";
        }    
    }

    public function tambah_tim_asesment() {
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) {
            redirect(site_url('proses_login_admin'));
        }
     	$this->load->view('super_admin_insert_asesment');
     }

    public function tambah_tim_asesment_proses() {
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in){
            redirect(site_url('proses_login_admin'));
        }

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
     	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in){
            redirect(site_url('proses_login_admin'));
        }

		$data['data_asesment']    = $this->admin_model->read_asesment()->result();
		$this->load->view('data_asesment', $data);
     }

     public function read_user(){
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in){
            redirect(site_url('proses_login_admin'));
        }

        $data['data_user'] = $this->admin_model->read_user()->result();
        $this->load->view('data_user',$data);
     }

      public function read_applications(){
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in){
            redirect(site_url('proses_login_admin'));
        }

        $data['applications'] = $this->admin_model->read_applications()->result();
        $this->load->view('inbox',$data);
     }

     public function edit_aplication($id_application) {
     	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in){
            redirect(site_url('proses_login_admin'));
        }
        $data['aplication'] = $this->admin_model->get_aplication($id_application)->result();
        $this->load->view('inbox_edit', $data);
     }

	public function edit_aplication_proses(){
     	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in){
            redirect(site_url('proses_login_admin'));
        }
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

	public function setujui_pengajuan($id_application_status){
     	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in){
            redirect(site_url('proses_login_admin'));
        }

        $cekData = $this->admin_model->get_aplication($id_application_status)->result();
        if($cekData->num_rows() > 0){
        	if($cekData->row()->process_status == 0){
    			$data = array(
	        		'process_status' => 1
	        		);
			 	}
			 	elseif ($cekData->row()->process_status == 1) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 2) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 3) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 4) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 5) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 6) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 7) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 8) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 9) 
			 	{
			 		# code...
			 	}
			 
		}else {
			echo "data tidak ditemukan";
		}

     }
	
	
 }
