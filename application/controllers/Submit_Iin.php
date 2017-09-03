<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class submit_iin extends CI_Controller {



	public function __construct() {
		
		parent::__construct();

		// load library dan helper
	   	$this->load->library('session');
	   	$this->load->helper(array('captcha','url','form','download'));
		$this->load->model('user_model');
		$this->load->library('email','form_validation', 'curl');
		$this->model = $this->user_model;
        $this->load->database();
		
	}
 
	public function index(){		
		$this->load->view('header');
		$this->load->view('submit-iin');
		$this->load->view('footer');
	}

	

	/*Melakukan penyimpanan form step ke 0*/ 
	public function insert_pengajuan_surat(){
// $id_user = $this->session->userdata('id_user');
// $username = $this->session->userdata('username');
	if($this->input->post('kirim') == "kirim"){
		$data = array(
		'id_user' => "1",
		/*id_admin yg update nanti dari sisi admin makanya di isi Null*/ 
		'id_admin' => "NULL",
		/*applicant yg ngisi user blm dpt cara make sesion disini*/
		'applicant' => "dicky",
		'applicant_phone_number' => "085725725725",
		'application_date' => $this->input->post('app_date'),
		'instance_name' => $this->input->post('app_instance'),
		' instance_email' => $this->input->post('app_mail'),
		'instance_phone' => $this->input->post('app_phone'),
		'instance_director' => $this->input->post('app_div'),
		'mailing_location' => $this->input->post('app_address'),
		'mailing_number' => $this->input->post('app_num'),
		'iin_status' => "0",
		/*application_type yg update nanti dari sisi admin makanya di isi Null*/
		'application_type' => "NULL",
		'created_date' => date('Y-m-j H:i:s'),
		/*created_by yg ngisi user blm dpt cara make sesion disini*/
		'created_by' =>"dicky",
		'last_updated_date' => date('Y-m-j H:i:s'),
		/*modified_by yg ngisi user blm dpt cara make sesion disini*/
		'modified_by' =>"dicky"
		);

		$this->user_model->insert_pengajuan($data);

	} else {
		echo "Dibatalkan";
	}	

	}
	/*Melkukan download di step2*/
	public function download_aplication_step2(){
	$id_application_file = $this->input->post('StepDuaFile');
	// Masih Dipantek datanya (id_user, id_application_file)
	$cek = $this->user_model->unduh_aplication_step2("1", "2");
	force_download( $cek->row()->path_file, NULL);
	}

	public function captcha()
	{
		$vals = array(
			//'word' => 'Random word',
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			//'font_path' => './path/to/fonts/texb.ttf',
			'img_width'	=> '120',
			'img_height' => 32,
			'border' => 0,
			'expiration' => 7200,
			'word_length' => 6,
			'font_size' => 20,
			//'img_id' => 'Imageid',
			//'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			
			// White background and border, black text and red grid
			
			'colors' => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 200, 200)
			)
		);
		$cap = create_captcha($vals);
		$this->session->set_userdata('mycaptcha', $cap['word']);
		$data = $cap['image'];
		return $data;
	}
	
 }
