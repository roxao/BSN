<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class submit_iin extends CI_Controller {



	public function __construct() {
		
		parent::__construct();

		/* load library dan helper*/
	   	$this->load->library('session', 'upload');
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
	public function insert_letter_submission(){
	$id_user = $this->session->userdata('id_user');
	$username = $this->session->userdata('username');
	if($this->input->post('kirim') == "kirim"){
		$data = array(
		'id_user' => $id_user,
		/*id_admin yg update nanti dari sisi admin makanya di isi Null*/ 
		'id_admin' => "NULL",
		'applicant' => $this->session->userdata('username'),
		'applicant_phone_number' => "085725725725",
		'application_date' => $this->input->post('app_date'),
		'instance_name' => $this->input->post('app_instance'),
		'instance_email' => $this->input->post('app_mail'),
		'instance_phone' => $this->input->post('app_phone'),
		'instance_director' => $this->input->post('app_div'),
		'mailing_location' => $this->input->post('app_address'),
		'mailing_number' => $this->input->post('app_num'),
		'iin_status' => "0",
		'application_type' => "NULL",
		'created_date' => date('Y-m-j H:i:s'),
		'created_by' => $username,
		'last_updated_date' => date('Y-m-j H:i:s'),
		'modified_by' =>$username);

		$this->user_model->insert_pengajuan($data);

	} else {
		echo "Dibatalkan";
	}	

	}
	/*Melkukan penarikan dokumen*/
	public function download(){
	// $id_user = $this->session->userdata('id_user');
	// $check = $this->user_model->getdocument_aplication($id_user);
	
	// if ($this->user_model->getdocument_aplication($id_user)){
	// 	// $data['download_upload']    = $this->user_model->getdocument_aplication($id_user);
	// 	// $this->load->view('header');
	// 	// $this->load->view('submit-iin', $data);

	// 	// $this->load->view('footer');
	// 	echo $check->row()->type;
	// }

	
	$iamge_id = $this->input->get('var1');
	// echo $iamge_id;
   force_download($iamge_id, NULL);	
	}

/*Melakukan Upload document*/
	 function aksi_upload() {

	 	$config['upload_path']          = './uploads/';
	$config['allowed_types']        = 'gif|jpg|png';
	$config['max_size']             = 100;
	$config['max_width']            = 1024;
	$config['max_height']           = 768;
 
	$this->load->library('upload', $config);
 
	if ( ! $this->upload->do_upload('berkas')){
		$error = array('error' => $this->upload->display_errors());
		// $this->load->view('v_upload', $error);
	}else{
		$data = array('upload_data' => $this->upload->data());
		// $this->load->view('v_upload_sukses', $data);
	}
        
     
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
