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
		'iin_status' => "OPEN",
		'application_type' => "NULL",
		'created_date' => date('Y-m-j H:i:s'),
		'created_by' => $username,
		'last_updated_date' => date('Y-m-j H:i:s'),
		'modified_by' =>$username);

		/*Insert Log*/
		$dataLog = array(
                'detail_log' => $username.' Created new application',
                'log_type' => 'added new applicant '.$username, 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
        $this->admin_model->insert_log($dataLog);
        /*Inser Pengajuan*/
		$this->user_model->insert_pengajuan($data);

		/*insert Status*/
		$Get_Document = $this->user_model->getdocument_aplication($id_user);
		if ($Get_Document->num_rows() > 0){
			if ($Get_Documen->row->id_application != "CLOSED" && $Get_Documen->row->id_application_status_name == "1" ){
				$data1 = array(
                'id_application '=> $Get_Documen->row->id_application,
                'id_application_status_name' => '1',
                'process_status' => 'PENDING',
                'approval_date' => 'null',
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'last_updated_date' => date('Y-m-j'));
			}
            $this->admin_model->insert_app_status($data1);
		}
	} else {
		echo "Dibatalkan";
	}	

	}
	/*Melkukan penarikan dokumen*/
	public function download(){
	
	$iamge_id = $this->input->get('var1');
   	force_download($iamge_id, NULL);	
	}

/*Melakukan Upload document*/
	 function do_upload() {

	 	 $this->load->library('upload');
  
      //Configure upload.
             $this->upload->initialize(array(
   "allowed_types" => "gif|jpg|png|jpeg",
                 "upload_path"   => "./upload/"
             ));
             //Perform upload.
             if($this->upload->do_upload("images")) {
                 $uploaded = $this->upload->data();
                 echo '<pre>';
   var_export($uploaded);
   echo '</pre>';

   

   /*insert Status*/
		$Get_Document = $this->user_model->getdocument_aplication($id_user);
		if ($Get_Document->num_rows() > 0){
			if ($Get_Documen->row->id_application != "CLOSED"){
			if ($Get_Documen->row->id_application_status_name == "4" && $Get_Documen->row->process_status == "PENDING"){


				/*Insert Log document Revisi*/
				$dataLog = array(
                'detail_log' => $username.' Upload Document',
                'log_type' => 'added new applicant '.$username, 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
       			 $this->admin_model->insert_log($dataLog);

				$data5 = array(
                'id_application '=> $Get_Documen->row->id_application,
                'id_application_status_name' => '5',
                'process_status' => 'PENDING',
                'approval_date' => 'null',
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'last_updated_date' => date('Y-m-j'));
                $this->admin_model->insert_app_status($data5);

                // Update 3 dan 4 belum

			} else {

				/*Insert Log Created document*/
				$dataLog = array(
                'detail_log' => $username.' Upload new Document',
                'log_type' => 'added new applicant '.$username, 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
       			 $this->admin_model->insert_log($dataLog);

				$data3 = array(
                'id_application '=> $Get_Documen->row->id_application,
                'id_application_status_name' => '3',
                'process_status' => 'PENDING',
                'approval_date' => 'null',
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'last_updated_date' => date('Y-m-j'));
                $this->admin_model->insert_app_status($data3);
			}

			}
            
		}
             }else{
   die('GAGAL UPLOAD');
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
