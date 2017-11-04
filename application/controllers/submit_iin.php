<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class submit_iin extends CI_Controller {
	public function __construct() {
		
		parent::__construct();
		/* load library dan helper*/
	   	$this->load->library('session', 'upload');
	   	$this->load->helper(array('captcha','url','form','download'));
		$this->load->model('user_model');
		$this->load->library('email','form_validation', 'curl','roxao_captcha');
		$this->model = $this->user_model;
        $this->load->database();
			
	}
 
	public function index(){		
		$this->load->view('header');
		$this->load->view('submit-iin');
		$this->load->view('footer');
		$this->captcha();
	}

	public function captcha()
	{

		$this->load->helper('captcha');
 		
		$vals = array(
			//'word' => 'Random word',
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'img_width'	=> '200',
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
		$this->session->set_userdata('myimgcaptcha', $cap['image']);
		 $data['image'] = $cap['image'];
		return $data;
	}
	

	/*
	INSERT LOG
	*/
	public function log($Type, $detail){
		/*Insert Log*/
		$username = $this->session->userdata('username');
		$dataLog = array(
                'detail_log' => $username. $detail,
                'log_type' => $Type .$username, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $username
                // ,
                // 'last_update_date' => date('Y-m-j H:i:s'),
                // 'modified_by' => date('Y-m-j H:i:s'),
                );
        $this->user_model->insert_log($dataLog);
	}
	


	/*
	Pengajuan Surat Permohonan Ke BSN
	@view step0.php
	*/
	public function step_0() {
		
		// $this->captcha();
		// $a = $this->session->userdata('status');

		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		} else {

			$id_user = $this->session->userdata('id_user');
			$first_validation = $this->user_model->step_0_validation_1($id_user)->row()->totals;

			// echo $first_validation;

			/*Validasi apakah ada applikasi yang status nya OPEN*/
			if ($first_validation == 0) {

				echo "|security_code : {$this->input->post('security_code')}|mycaptcha : {$this->session->userdata('mycaptcha')}";

				echo "$ {$this->input->post('batal')} $";

				if($this->input->post('kirim')  == 'kirim') {

					$get_document = $this->user_model->get_applications_Status($id_user);
					$username = $this->session->userdata('username');

					if (($this->input->post('security_code') == $this->session->userdata('mycaptcha'))){
						echo "|MASUK Captcha";
						$data = array(
						'id_user' => $id_user,
						'applicant' => $this->input->post('app_applicant'),
						'applicant_phone_number' => $this->input->post('app_no_applicant'),
						'application_date' => date('Y-m-j', strtotime( $this->input->post('app_date') )),
						// 'application_date' => $this->input->post('app_date'),
						'application_purpose' => $this->input->post('app_purpose'),
						'instance_name' => $this->input->post('app_instance'),
						'instance_email' => $this->input->post('app_mail'),
						'instance_phone' => $this->input->post('app_phone'),
						'instance_director' => $this->input->post('app_div'),
						'mailing_location' => $this->input->post('app_address'),
						'mailing_number' => $this->input->post('app_num'),
						'iin_status' => "OPEN",
						'application_type' => "new",
						'created_date' => date('Y-m-j H:i:s'),
						'created_by' => $username);

						/*insert Status 1 Pending*/
						// if ( is_null($get_document->row()->iin_status ) ) {
						if ( $get_document->row()->iin_status != 'OPEN' ) {
							// echo  "application_date : {$data['application_date']}";
							/*Insert Pengajuan*/
							$inserted_id = $this->user_model->insert_pengajuan($data);
							echo "|inserted_id : {$inserted_id}|num rows : {$get_document->num_rows()}";
							
							$data1 = array(
				                // 'id_application '=> $get_document->row()->id_application,
				                'id_application '=> $inserted_id,
				                'id_application_status_name' => '1',
				                'process_status' => 'PENDING',	
				                'created_date' => date('Y-m-j'),
				                'created_by' => $username
			            	);
				            $this->user_model->insert_app_status($data1);
							
							/*
							AUDIT TRAIL Step 0
							*/
							$this->log("added new application","Created new application");
					        
					        /*
				            	REMINDER : 
				            	At this point , user should be stuck in this page
								and waiting for admin verification
				            */
							redirect(base_url("Layanan-IIN"));
				            
						} else {
							echo "|ERR: Controller submit_iin - function step_0";
						}
						

					} else {
						$this->session->set_flashdata('validasi-captcha', 'Captcha tidak sesuai');
						echo "Tidak Sama";
						redirect(base_url("Layanan-IIN"));
					}
				} else {
					echo "Dibatalkan";
					redirect(base_url("Layanan-IIN"));
				}
			} else {
				echo "|Tidak dapat melakukan pengajuan - Masih ada aplikasi dengan iin_status 'OPEN'|";
			}
		}
	}


	/*
	This function will validate id_application exist, and current id_application_status_name
	*/
	public function check_step_status($name) {

		$id_user = $this->session->userdata('id_user');
		echo "|id_user : {$id_user}";
		echo "|name : {$name}";

		/*
		Validate id_application 
		*/
		$get_id_application = $this->user_model->get_id_application($id_user);
		if ( !is_null($get_id_application->row()->id_application) ) {
			$id_application = $get_id_application->row()->id_application;
			$created_by = $get_id_application->row()->created_by;
			echo "|id_application : {$id_application}";
			echo "|created_by : {$created_by}";


			/*
			Validate id_application_status_name 2 exist
			*/
			$get_id_application_status_name = $this->user_model->get_id_application_status_name($id_application, $name);
			if ( empty($get_id_application_status_name->row()->id_application_status_name) ) {
				// $id_application_status_name = $get_id_application_status_name->row()->id_application_status_name;
				// echo "|id_application_status_name : {$id_application_status_name}";

				$app_status = array(
		            'id_application '=> $id_application,
		            'id_application_status_name' => $name,
		            'process_status' => 'COMPLETED',	
		            'created_date' => date('Y-m-j'),
		            'created_by' => $created_by
		    	);

		    	// echo json_encode($app_status);

		        // $this->user_model->insert_app_status($app_status);

		    	return $app_status;

			} else {
				echo "ERROR :: Controller submit_iin | name : {$name} | id_application_status_name ALREADY EXIST!";
				return "x";
			}

		} else {
			echo "ERROR :: Controller submit_iin | name : {$name} | id_application NOT FOUND!";
			return "x";
		}
	}

	public function check_app_status() {
		/*
		Get id_user from session
		*/
		$id_user = $this->session->userdata('id_user');

		/*
		Get Application Status 
		*/
		$get_app_status =  $this->user_model->get_applications_Status($id_user);

		/*
		Validate If row Exist 
		*/
		if ( !is_null($get_app_status->row()->id_application) ) {

			$iin_status = $get_app_status->row()->iin_status;
			$id_application = $get_app_status->row()->id_application;
			$created_by = $get_app_status->row()->created_by;
			// echo "|get_app_status : ";
			// print_r($get_app_status);
			echo "|iin_status : {$iin_status}";
			echo "|id_application : {$id_application}";
			echo "|created_by : {$created_by}";


			$app_status = array(
	            'iin_status'=> $iin_status,
	            'id_application'=> $id_application,
	            'created_by' => $created_by
	    	);
		    
			/*
			Validate id_application_status_name  exist
			*/
			if ( !is_null($get_app_status->row()->id_application_status_name) ) {
				$id_application_status_name = $get_app_status->row()->id_application_status_name;
				$process_status = $get_app_status->row()->process_status;
				echo "|id_application_status_name : {$id_application_status_name}";
				echo "|process_status : {$process_status}";

				$app_status['id_application_status_name'] = $id_application_status_name;
				$app_status['process_status'] = $process_status;

			}
			
		    return $app_status;

		} else {
			echo "ERROR :: Controller submit_iin - check_app_status | id_application NOT FOUND!";
			return "x";
		}

	}
	/*
	
	*/
	public function step_1() {


		/*
		THIS METHOD USING check_step_status function
		*
		*/
		// $name = '2';
		// $app_status = $this->check_step_status($name);
		// // echo "app_status : {$app_status}";
		// echo json_encode($app_status);

		// if ($app_status != 'x') {
		// 	$this->user_model->insert_app_status($app_status);
		// } else {
		// 	echo "ERROR :: Controller submit_iin | name : {$name} | id_application_status_name ALREADY EXIST!";
		// }


		/*
		THIS METHOD USING check_app_status function 
		(to Simplify and FIX check_step_status flaws)
		*
		*/

		/*
		Instantiate app_status
		*/
		$app_status = $this->check_app_status();

		/*
		Validate app_status
		@ app_status value should be an array including
		*/
		if ($app_status != 'x') {

			$step_status_name = '2';
			echo "|TEST";

			$id_application_status_name = $app_status['id_application_status_name'];
			echo "|id_application_status_name : {$id_application_status_name}";

			if ( $id_application_status_name != $step_status_name ) {
				
				echo json_encode($app_status);

				echo "|TEST2";
				$process_status = $app_status['process_status'];
				echo "|process_status : {$process_status}";


				$id_application = $app_status['id_application'];
				echo "|id_application : {$id_application}";
				
				/*
				Instantiate arr_status
				@ Using values from app_status array
				@ Update The Value of id_application_status_name
				@ Update The Value of process_status
				*
				*/
				$arr_status = array(
		            'id_application '=> $app_status['id_application'],
		            'id_application_status_name' => $step_status_name,
		            'process_status' => 'COMPLETED',	
		            'created_date' => date('Y-m-j'),
		            'created_by' => $app_status['created_by']
		    	);

				/*
				Update The Value of application_status Table
				*/
				$this->user_model->insert_app_status($arr_status);

			}

			redirect(base_url("Layanan-IIN"));

		} else {
			echo "ERROR :: Controller submit_iin - check_app_status | id_application NOT FOUND!";
		}

	}

	/*
	
	*/
	public function step_2() {

	}

	/*
	
	*/
	public function step_3() {

	}

	/*
	
	*/
	public function step_4() {

	}
	

	/*
	
	*/
	public function step_5(){

	}

	/*
	view rejected.php
	*/
	public function step_rejected() {

		/*
		Get id_user from session
		*/
		$id_user = $this->session->userdata('id_user');
		echo "|id_user : {$id_user}";
		
		/*
		Get Application Status 
		*/
		$get_app_status =  $this->user_model->get_applications_Status($id_user);

		/*
		Validate If row Exist 
		*/
		if ($get_app_status->row()->iin_status != 'NULL') {

			// $iin_status = $get_app_status->row()->iin_status;
			// $process_status = $get_app_status->row()->process_status;
			// echo "|iin_status : {$iin_status}";
			// echo "|process_status : {$process_status}";

			$id_application = $get_app_status->row()->id_application;
			$id_application_status_name = $get_app_status->row()->id_application_status_name;
			$username = $get_app_status->row()->created_by;
			// echo "|get_app_status : ";
			// print_r($get_app_status);
			echo "|id_application : {$id_application}";
			echo "|id_application_status_name : {$id_application_status_name}";
			echo "|username : {$username}";

			/*
			Update applications Table
			*/
			$this->user_model->update_applications("CLOSED", $id_application, $username	);

			echo "|iin_status_updated : CLOSED";
			/*
			Update application_status Table
			*/
			$this->user_model->update_aplication_status("COMPLETED", $id_application, $id_application_status_name, $username);

			/*
			AUDIT TRAIL application rejected
			*/
			$this->log("Mengakhiri Pengajuan","Application Rejected");

			echo "|process_status_updated : COMPLETED";
		}

		// redirect(base_url());
	}


	public function insert_letter_submission() {
		
		$a = $this->session->userdata('status');
		echo $a."\r";
		// echo base_url()."\r";
		// echo base_url(TRUE, TRUE, TRUE)."\r";
		// redirect(base_url().'SipinHome',refresh);
		// redirect(base_url("SipinHome/submitiin"));




		if($this->session->userdata('status') != "login"){
			redirect(base_url(""));
		} else {

			// $this->SipinHome->captcha();
			/*Validasi apakah ada applikasi yang status nya OPEN*/
			// if ($a == '1') {

				echo "|security_code : {$this->input->post('security_code')}|mycaptcha : {$this->session->userdata('mycaptcha')}";

				echo "$ {$this->input->post('batal')} $";

				if($this->input->post('kirim')  == 'kirim') {

					$id_user = $this->session->userdata('id_user');
					$get_document = $this->user_model->get_applications_Status($id_user);
					$username = $this->session->userdata('username');

					if (($this->input->post('security_code') == $this->session->userdata('mycaptcha'))){
						
						$data = array(
						'id_user' => $id_user,


						/*id_admin yg update nanti dari sisi admin makanya di isi Null*/ 
						// 'id_admin' => "NULL",
						// 'applicant' => $this->session->userdata('username'),
						// 'applicant_phone_number' => "085725725725",


						'applicant' => $this->input->post('app_applicant'),
						'applicant_phone_number' => $this->input->post('app_no_applicant'),
						'application_date' => $this->input->post('app_date'),
						'instance_name' => $this->input->post('app_instance'),
						'instance_email' => $this->input->post('app_mail'),
						'instance_phone' => $this->input->post('app_phone'),
						'instance_director' => $this->input->post('app_div'),
						'mailing_location' => $this->input->post('app_address'),
						'mailing_number' => $this->input->post('app_num'),
						'iin_status' => "OPEN",
						'application_type' => "New",
						'created_date' => date('Y-m-j H:i:s'),
						'created_by' => $username,
						'modified_date' => date('Y-m-j H:i:s'),
						'modified_by' =>$username);

						/*
						AUDIT TRAIL Step 1
						*/
						$this->log("added new application","Created new application");
				        /*Insert Pengajuan*/
						$a = $this->user_model->insert_pengajuan($data);



						/*insert Status 1 Pending*/
						if ($get_document->num_rows() > 0){
							echo "|inserted_id : {$a}|num rows : {$get_document->num_rows()}";
								$data1 = array(
				                // 'id_application '=> $get_document->row()->id_application,
				                'id_application '=> $a,
				                'id_application_status_name' => '1',
				                'process_status' => 'PENDING',	
				                'created_date' => date('Y-m-j'),
				                'created_by' => $username,
				                'modified_by' => $username,
				                'last_updated_date' => date('Y-m-j'));
				            $this->user_model->insert_app_status($data1);
						
				            /*
				            	REMINDER : 
				            	At this point , user should be stuck in this page
								and waiting for admin verification
				            */
							// redirect(base_url().'SipinHome',refresh);

						}
					} else {
						$this->session->set_flashdata('validasi-captcha', 'Captcha tidak sesuai');
						echo "Tidak Sama";
						// redirect(base_url().'SipinHome',refresh);
						// redirect(base_url("SipinHome/submitiin/"));
					}
				} else {
					echo "Dibatalkan";
						// redirect(base_url(""));
						// redirect(base_url().'SipinHome',refresh);
				}
			// } else {

			// }

		}
	}


	/*Melakukan penarikan dokumen*/
	public function download(){
	
	if($this->session->userdata('status') != "login"){
			redirect(base_url("SipinHome"));
		}

	$iamge_id = $this->input->get('var1');
   	force_download($iamge_id, NULL);	
	}


	function  step_tiga_upload (){
		$id_user = $this->session->userdata('id_user');
		$get_status = $this->user_model->get_applications_Status($id_user);
		$id_app = $this->user_model->get_aplication($id_user);
		$username = $this->session->userdata('username');
		/*insert Status*/
		// if ($get_document->num_rows() > 0){
		
		if ($get_status->row()->id_application_status_name =="4"){
				if ($get_status->row()->id_application_status_name =="PENDING"){
					$this->log("Revisi document","Revisi step3");
					$this->user_model->update_aplication_status("COMPLETED", $get_status->row()->id_application, "4", $username);
					$data5 = array(
                'id_application '=> $get_status->row()->id_application,
                'id_application_status_name' => '5',
                'process_status' => 'PENDING',
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'modified_date' => date('Y-m-j'));
                $this->user_model->insert_app_status($data5);
				}
		} 
		else {
			// if  ($get_status->row()->id_application_status_name =="3"){ 

			$data1 = array(
                'id_application '=> $id_app->row()->id_application,
                'id_application_status_name' => '3',
                'process_status' => 'PENDING',	
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'modified_date' => date('Y-m-j'));
            $this->user_model->insert_app_status($data1);

		}

	}


	function  step_enam_upload (){
	$id_user = $this->session->userdata('id_user');
	$get_status  = $this->user_model->get_applications_Status($id_user);
	$username = $this->session->userdata('username');
		 /*insert Status*/
		if ($get_status->num_rows() > 0){

			$this->user_model->update_aplication_status("COMPLETED", $get_status->row()->id_application, "7", $username);
		
				$this->log("Upload new document","Upload new document step6");
				$data3 = array(
                'id_application '=> $get_status->row()->id_application,
                'id_application_status_name' => '9',
                'process_status' => 'PENDING',
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'last_updated_date' => date('Y-m-j'));
                $this->user_model->insert_app_status($data3);
                     
            // 7 Belum dirubah jadi update
		}
	}
	
	function  step_tujuh_team (){
		$id_user = $this->session->userdata('id_user');
		$get_status  = $this->user_model->get_applications_Status($id_user);
		$username = $this->session->userdata('username');
		 /*insert Status*/
		if ($get_status->num_rows() > 0){
		
			$this->log("Upload confirmation payment","Upload nconfirmation payment");
			$data3 = array(
            'id_application '=> $get_status->row()->id_application,
            'id_application_status_name' => '14',
            'process_status' => 'PENDING',
            'created_date' => date('Y-m-j'),
            'created_by' => $username,
            'modified_by' => $username,
            'last_updated_date' => date('Y-m-j'));
            $this->user_model->insert_app_status($data3);
			$this->user_model->update_aplication_status("COMPLETED", $get_status->row->id_application, "12", $username);
			
		}
	}

	/*Melakukan Upload document*/
	// function do_upload() {

			/*
			If new upload, show all 12 files
			*/

			/*
			If revision upload, show only revision files
			*/

	// }
	
	/*Melakukan Upload document*/
	function do_upload() {

	 	if($this->session->userdata('status') != "login"){
			redirect(base_url("SipinHome"));
		}

		$id_user = $this->session->userdata('id_user');
		$get_document = $this->user_model->get_aplication($id_user);
		$username = $this->session->userdata('username');
		$query = 0;
	 	$this->load->library('upload');
 
      	//Configure upload.
         $this->upload->initialize(array(
			 "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
             "upload_path"   => "./upload/"
         ));
        
        //Perform upload.
		if($this->upload->do_upload("images")) {
		
			// if($this->upload->do_upload()) {
             $uploaded = $this->upload->data();
            
            if ($this->input->post('upload') == "uploadstep3"){
				// $query = $this->user_model->getdocument_aplication_forUpload($id_user, "document_config.type", "DYNAMIC", "ACTIVE");
				$query = $this->user_model->get_doc_user_upload();

			} else if ($this->input->post('upload') == "uploadstep6") {
				 $query = $this->user_model->getdocument_aplication_forUpload($id_user, "document_config.key", "BT PT", "ACTIVE");
			}

				/*Query Di Looping Menggunakan Buble Short Supaya mudah di pahami*/
				for ($j = 0; $j < count($query); $j++){
				   	/*Array Image di parsing*/
					for ($i = 0; $i < count($uploaded); $i++) {
						/*Disamain Indexnnya Setelah Index Sama Baru di Insert ke DB*/
					 	if ($j == $i){
				 			/*Query Insert FilePathnya ke DB*/
							if ($this->input->post('upload') == "uploadstep6"){
								$this->user_model->update_document( $query[$j]->id_application, $query[$j]->id_application_file, $query[$j]->id_document_config, $uploaded['full_path'], $username);
							} else if ($this->input->post('upload') == "uploadstep3"){
								$dataFile = array(
									'id_document_config' => $query[$i]->id_document_config,
									'id_application' => $get_document->row()->id_application,
									'path_id' => $uploaded[$i]['full_path'],
									'status' => 'ACTIVE',
									'created_date' => date('y-m-d'),
									'created_by' => $this->session->userdata('username'));

								$this->user_model->insert_app_file($dataFile);

							}

				 		}
					}
				}
		} else{
				die('GAGAL UPLOAD');
  		} 
 
		if ($this->input->post('upload') == "uploadstep3"){
			$this->step_tiga_upload();
		} 
		else if ($this->input->post('upload') == "uploadstep6") {
			 $this->step_enam_upload();
		}
	} 
 
	
	
}