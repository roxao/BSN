<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class submit_iin extends CI_Controller {
	public function __construct() {
		
		parent::__construct();
		/* load library dan helper*/
	   	$this->load->library('session', 'upload');
	   	$this->load->helper(array('captcha','url','form','download'));
		$this->load->model('user_model');
		$this->load->model('admin_model');
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

	public function date_time_now() {
		/*
		SET TIMEZONE ASIA/JAKARTA
		*/
	    $datetime = new DateTime('Asia/Jakarta');
	    // $datetime = new DateTime('Europe/Moscow');
	    return $datetime->format('Y\-m\-d\ H:i:s');
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
	public function log($type, $detail){
		/*Insert Log*/
		$username = $this->session->userdata('username');
		$dataLog = array(
                // 'detail_log' => $username. $detail,
                'detail_log' => "{$detail} : {$username}",
                // 'log_type' => $Type .$username, 
                'log_type' => $type,
                // 'created_date' => date('Y-m-j H:i:s'),
                'created_date' => $this->date_time_now(),
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
				                // 'created_date' => date('Y-m-j'),
				                'created_date' => $this->date_time_now(),
				                'created_by' => $username
			            	);
				            $this->user_model->insert_app_status($data1);
							
							/*
							AUDIT TRAIL Step 0
							*/
							$this->log("Added New Application","Created new application by");
					        
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
		THIS METHOD USING check_app_status function 
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
			// echo "|TEST";

			$id_application_status_name = $app_status['id_application_status_name'];
			echo "|id_application_status_name : {$id_application_status_name}";

			if ( $id_application_status_name == $step_status_name ) {
			// if ( $id_application_status_name = $step_status_name ) {
				
				echo json_encode($app_status);

				// echo "|TEST2";
				// $process_status = $app_status['process_status'];
				// echo "|process_status : {$process_status}";


				// $id_application = $app_status['id_application'];
				// echo "|id_application : {$id_application}";
				
				/*
				Instantiate arr_status
				@ Using values from app_status array
				@ Update The Value of id_application_status_name
				@ Update The Value of process_status
				*
				*/
				// $arr_status = array(
		  //           'id_application '=> $app_status['id_application'],
		  //           'id_application_status_name' => $step_status_name,
		  //           'process_status' => 'COMPLETED',	
		  //           // 'created_date' => date('Y-m-j'),	
		  //           'created_date' => $this->date_time_now(),
		  //           'created_by' => $app_status['created_by']
		  //   	);

				/*
				Update The Value of application_status Table
				*/
				// $this->user_model->insert_app_status($arr_status);

				$this->user_model->update_aplication_status('COMPLETED', $app_status['id_application'], $step_status_name, $this->session->userdata('username'));

				/*
				AUDIT TRAIL Step 1
				*/
				$this->log("New Application Verified","Application Verified | Applicant");
		        
			}

			redirect(base_url("Layanan-IIN"));

		} else {
			echo "ERROR :: Controller submit_iin - check_app_status | id_application NOT FOUND!";
		}

	}

	/*
	
	*/
	public function step_2($uploaded, $key) {

		$logMsg = "";

		$limit = count($uploaded);
		echo "|limit : {$limit}";

		// $id_application = $this->input->post('id_application');
		$id_application = $this->session->userdata('id_application');
		echo "|id_application : {$id_application}";
		$id_application_status = $this->session->userdata('id_application_status');
		echo "|id_application_status : {$id_application_status}";
		$id_application_status_name = $this->session->userdata('id_application_status_name');
		echo "|id_application_status_name : {$id_application_status_name}";


		echo "| uploaded : ".json_encode($uploaded);


		// echo "| no_count : {$no_count}";

		// $explode_str = explode(",", $no_count);
		// echo "|count  : ".count($explode_str);
		
		

		if ( $id_application_status_name == '2' ) {
			/*
			NORMAL FILE UPLOAD
			*/

			/*
			GET list of document
			@Table : document_config
			*/
			$query = $this->user_model->get_doc_user_upload($key,'','');

			for ( $i = 0; $i < $limit; $i++ ) {
				$dataFile = array(
					'id_document_config' => $query[$i]->id_document_config,
					// 'id_document_config' => $explode_str[$i],
					'id_application' =>	 $id_application,
					'path_id' => $uploaded[$i]['full_path'],
					'status' => 'ACTIVE',
		            'created_date' => date('Y-m-j'),
					'created_by' => $this->session->userdata('username')
				);

				/*
				Insert application_file Table
				@Insert New Files Uploaded by User
				*/
				$this->user_model->insert_app_file($dataFile);
			}

			$id_application_status_name = '3';

			/*
			..INSERT application_status Table..
			*/
			$app_status = array(
	            'id_application '=> $id_application,
	            'id_application_status_name' => $id_application_status_name,
	            'process_status' => 'PENDING',	
	            'created_date' => $this->date_time_now(),
	            // 'created_date' => date('Y-m-j'),
	            'created_by' => $this->session->userdata('username')
	    	);
			
	        $this->user_model->insert_app_status($app_status);

		} elseif ( $id_application_status_name == '4' ) {
			/*
			..REVISION FILE UPLOAD..
			*/
			// echo "| $ REVSTART $ ";

			$process_status = 'COMPLETED';

			/*
			Get List of Revision File
			*/
			$data = $this->session->userdata('step2_upload');
			$list_id_form_mapping = $this->session->userdata('list_id_form_mapping');

			// echo "|".json_encode($data);


			/*
			..UPDATE application_status Table..
			@ update id_application_status_name 4 = 'COMPLETED'
			*/
	        $this->user_model->update_aplication_status('COMPLETED', $id_application, $id_application_status_name, $this->session->userdata('username'));

			$id_application_status_name = '5';

			/*
			..INSERT application_status Table..
			*/
			$app_status = array(
	            'id_application '=> $id_application,
	            'id_application_status_name' => $id_application_status_name,
	            'process_status' => 'PENDING',	
	            'created_date' => $this->date_time_now(),
	            // 'created_date' => date('Y-m-j'),
	            'created_by' => $this->session->userdata('username')
	    	);
			
	        $inserted_id = $this->user_model->insert_app_status($app_status);

			// $app_file = array();
			foreach ($data as $index => $valIndex) {
				# code...
				// echo "| index : {$index}";
				// echo "| list_id_form_mapping : {$list_id_form_mapping[$index]}";

				/*
				Insert application_file Table
				@Insert New Files Uploaded by User
				*/
				$app_file =  array(
					// 'id_document_config' => $query[$index]->id_document_config,
					'id_application' =>	 $id_application,
					'path_id' => $uploaded[$index]['full_path'],
					'status' => 'ACTIVE',
		            'created_date' => $this->date_time_now(),
					'created_by' => $this->session->userdata('username')
				);

				foreach ($valIndex as $key => $val) {
					# code...

					/*
					Validate $key== id_document_config
					*/
					if ($key == 'id_document_config') {
						$app_file['id_document_config'] = $val;
					}

					/*
					Validate $key== key
					*/
					if ($key == 'key') {
						/*
						Insert application_status_form_mapping Table
						@Insert KEY of revision Files Uploaded by User
						*/
						$form_map = array(
							'id_application_status' => $inserted_id,
							'type' => 'REVISION_FILE '.$val,
							'value' => $val,
				            'created_date' => $this->date_time_now(),
							'created_by' => $this->session->userdata('username')
						);

						// echo "|".json_encode($form_map);


						$this->user_model->set_app_form($form_map, $list_id_form_mapping[$index]);

						// $this->user_model->update_app_form($form_map, $list_id_form_mapping[$index]);

						/*
						..INSERT log Table..
						*/
						// $this->log("Revisi Form Mapping","Revision Form Mapping Submitted by");
					}
				}


				$this->user_model->insert_app_file($app_file);
				echo "|".json_encode($app_file);
			}

			


			$logMsg = "Revision ";
		

		}

		// echo "|".json_encode($app_status);

		

		/*
		..INSERT log Table..
		*/
		$this->log("{$logMsg}Submit Document","Application Files Submitted by");
	}	


	/*
	
	*/
	public function step_4() {
		/*
		THIS METHOD USING check_app_status function 
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
			$step_status_name = '7';
			// echo "|TEST";

			$id_application_status_name = $app_status['id_application_status_name'];
			echo "|id_application_status_name : {$id_application_status_name}";

			if ( $id_application_status_name == $step_status_name ) {

				$this->user_model->update_aplication_status('COMPLETED', $app_status['id_application'], $step_status_name, $this->session->userdata('username'));

				/*
				AUDIT TRAIL Step 1
				*/
				$this->log("User Download Billing Code","Billing Code Downloaded | Applicant");
		        
			}

			redirect(base_url("Layanan-IIN"));
		}
	}
	

	/*
	
	*/
	public function step_5($uploaded, $key_arr){
		

		$logMsg = "";

		$limit = count($uploaded);
		echo "|limit : {$limit}";

		// $id_application = $this->input->post('id_application');
		$id_application = $this->session->userdata('id_application');
		echo "|id_application : {$id_application}";
		$id_application_status = $this->session->userdata('id_application_status');
		echo "|id_application_status : {$id_application_status}";
		$id_application_status_name = $this->session->userdata('id_application_status_name');
		echo "|id_application_status_name : {$id_application_status_name}";


		echo "| uploaded : ".json_encode($uploaded);

		echo "| key : ".json_encode($key_arr)."|";



		// echo "| no_count : {$no_count}";

		// $explode_str = explode(",", $no_count);
		// echo "|count  : ".count($explode_str);
		
		

		if ( $id_application_status_name == '7' ) {
			/*
			NORMAL FILE UPLOAD
			*/

			/*
			GET list of document
			@Table : document_config
			*/
			$query = $this->user_model->get_doc_user_upload($key_arr,'','');
			echo json_encode($query);

			for ( $i = 0; $i < $limit; $i++ ) {
				$dataFile = array(
					'id_document_config' => $query[$i]->id_document_config,
					// 'id_document_config' => $explode_str[$i],
					'id_application' =>	 $id_application,
					'path_id' => $uploaded[$i]['full_path'],
					'status' => 'ACTIVE',
		            'created_date' => date('Y-m-j'),
					'created_by' => $this->session->userdata('username')
				);

				/*
				Insert application_file Table
				@Insert New Files Uploaded by User
				*/
				$this->user_model->insert_app_file($dataFile);
			}

			$id_application_status_name = '9';

			/*
			..INSERT application_status Table..
			*/
			$app_status = array(
	            'id_application '=> $id_application,
	            'id_application_status_name' => $id_application_status_name,
	            'process_status' => 'PENDING',	
	            'created_date' => $this->date_time_now(),
	            // 'created_date' => date('Y-m-j'),
	            'created_by' => $this->session->userdata('username')
	    	);
			
	        $this->user_model->insert_app_status($app_status);

		} elseif ( $id_application_status_name == '10' ) {
			/*
			..REVISION FILE UPLOAD..
			*/
			// echo "| $ REVSTART $ ";

			$process_status = 'COMPLETED';

			/*
			Get List of Revision File
			*/

			$id_doc_arr = $this->user_model->get_doc_user_upload($key_arr,'','');
			// echo "ASUW!".json_encode($id_doc_arr);


			$list_id_form_mapping = $this->session->userdata('list_id_form_mapping');

			// echo "|".json_encode($data);


			/*
			..UPDATE application_status Table..
			@ update id_application_status_name 10 = 'COMPLETED'
			*/
	        $this->user_model->update_aplication_status('COMPLETED', $id_application, $id_application_status_name, $this->session->userdata('username'));

			$id_application_status_name = '11';

			/*
			..INSERT application_status Table..
			*/
			$app_status = array(
	            'id_application '=> $id_application,
	            'id_application_status_name' => $id_application_status_name,
	            'process_status' => 'PENDING',	
	            'created_date' => $this->date_time_now(),
	            // 'created_date' => date('Y-m-j'),
	            'created_by' => $this->session->userdata('username')
	    	);
			
	        $inserted_id = $this->user_model->insert_app_status($app_status);


			// $app_file = array();
			foreach ($uploaded as $index => $valIndex) {
				# code...
				// echo "| index : {$index}";
				// echo "| list_id_form_mapping : {$list_id_form_mapping[$index]}";

				/*
				Insert application_file Table
				@Insert New Files Uploaded by User
				*/
				$app_file =  array(
					'id_document_config' => $id_doc_arr[$index]->id_document_config,
					// 'id_document_config' => $query[$index]->id_document_config,
					'id_application' =>	 $id_application,
					'path_id' => $uploaded[$index]['full_path'],
					'status' => 'ACTIVE',
		            'created_date' => $this->date_time_now(),
					'created_by' => $this->session->userdata('username')
				);

				foreach ($valIndex as $key => $val) {
					# code...

					/*
					Validate $key== id_document_config
					*/
					// if ($key == 'id_document_config') {
					// 	$app_file['id_document_config'] = $val;
					// }

					/*
					Validate $key== key
					*/
					if ($key == 'key') {
						/*
						Insert application_status_form_mapping Table
						@Insert KEY of revision Files Uploaded by User
						*/
						$form_map = array(
							// 'id_application_status' => $inserted_id,
							'type' => 'REVISION_PAY '.$val,
							'value' => $key_arr,
				            'created_date' => $this->date_time_now(),
							'created_by' => $this->session->userdata('username')
						);

						// echo "| FOOORRMMMM MAAAPP :".json_encode($form_map);


						$this->user_model->set_app_form($form_map, $list_id_form_mapping[$index]);


						/*
						..INSERT log Table..
						*/
						$this->log("Revisi Form Mapping","Revision Form Mapping Submitted by");
					}
				}


				$this->user_model->insert_app_file($app_file);
				// echo "| ASUUUUWWWW".json_encode($app_file);
			}

			


			$logMsg = "Revision ";
		

		}

		// echo "|".json_encode($app_status);

		

		/*
		..INSERT log Table..
		*/
		$this->log("{$logMsg}Submit Payment","Payment Submitted by");
	}



	public function step_6(){

		/*
		THIS METHOD USING check_app_status function 
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
			$step_status_name = '12';
			// echo "|TEST";

			$id_application_status_name = $app_status['id_application_status_name'];
			echo "|id_application_status_name : {$id_application_status_name}";

			if ( $id_application_status_name == $step_status_name ) {

				/*
				Update Application Status 12
				*/
				$this->user_model->update_aplication_status('COMPLETED', $app_status['id_application'], $step_status_name, $this->session->userdata('username'));


				$id_application_status_name = '14';

				/*
				..INSERT application_status Table.. (application status 14)
				*/
				$app_status = array(
		            'id_application '=> $app_status['id_application'],
		            // 'id_application '=> $id_application,
		            'id_application_status_name' => $id_application_status_name,
		            'process_status' => 'PENDING',	
		            'created_date' => $this->date_time_now(),
		            // 'created_date' => date('Y-m-j'),
		            'created_by' => $this->session->userdata('username')
		    	);
				
		        $this->user_model->insert_app_status($app_status);

				/*
				AUDIT TRAIL Step 1
				*/
				$this->log("User Approved Verification Team","Verification Team  Approved | Applicant");
		        
			}

			redirect(base_url("Layanan-IIN"));
		}
		



		
	}

	public function step_6_rev(){
		
		/*
		THIS METHOD USING check_app_status function 
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
			// $id_application = $this->input->post('id_application');
			$id_application = $this->session->userdata('id_application');
			echo "|id_application : {$id_application}";
			$id_application_status = $this->session->userdata('id_application_status');
			echo "|id_application_status : {$id_application_status}";
			$id_application_status_name = $this->session->userdata('id_application_status_name');
			echo "|id_application_status_name : {$id_application_status_name}";


			$data = array(
				'rev_assess_date' => date('Y-m-j', strtotime( $this->input->post('rev_assess_date')))
			);

			$rev_assess_date = date('Y-m-j', strtotime( $this->input->post('rev_assess_date')));

			/*
			..INSERT log Table..
			*/
			$this->log("Revisi Form Mapping","Revision Form Mapping Submitted by");

			/*
			..UPDATE application_status Table..
			@ update id_application_status_name 12 = 'COMPLETED'
			*/
	        $this->user_model->update_aplication_status('COMPLETED', $id_application, $id_application_status_name, $this->session->userdata('username'));

			echo "|DATA  : ".json_encode($data);


			/*
			..INSERT application_status Table.. (application status 13)
			*/
			$app_status = array(
	            'id_application '=> $id_application,
	            'id_application_status_name' => '13',
	            'process_status' => 'PENDING',	
	            'created_date' => $this->date_time_now(),
	            // 'created_date' => date('Y-m-j'),
	            'created_by' => $this->session->userdata('username')
	    	);


			echo "|APP STATUS  : ".json_encode($app_status);
			
	        $inserted_id = $this->user_model->insert_app_status($app_status);

	        $form_map = array(
				'id_application_status' => $inserted_id,
				'type' => 'REVISION_ASSESSMENT_DATE',
				'value' => $rev_assess_date,
	            'created_date' => $this->date_time_now(),
				'created_by' => $this->session->userdata('username')
			);

			$this->user_model->set_app_form($form_map);
		}

	}

	public function step_7($uploaded, $keys){


		$limit = count($uploaded);
		echo "|limit : {$limit}";

		// $id_application = $this->input->post('id_application');
		$id_application = $this->session->userdata('id_application');
		echo "|id_application : {$id_application}";
		$id_application_status = $this->session->userdata('id_application_status');
		echo "|id_application_status : {$id_application_status}";
		$id_application_status_name = $this->session->userdata('id_application_status_name');
		echo "|id_application_status_name : {$id_application_status_name}";


		echo "| uploaded : ".json_encode($uploaded);



		if ( $id_application_status_name == '16' ) {
			/*
			..REVISION FILE UPLOAD..
			*/
			echo "| $ REVSTART $ ";


			// echo "| $ REVSTART $ ";

			$process_status = 'COMPLETED';

			/*
			Get List of Revision File
			*/


			// $data = $this->session->userdata('step2_upload');
			// $list_id_form_mapping = $this->session->userdata('list_id_form_mapping');

			// echo "|".json_encode($data);


			/*
			..UPDATE application_status Table..
			@ update id_application_status_name 4 = 'COMPLETED'
			*/
	        $this->user_model->update_aplication_status('COMPLETED', $id_application, $id_application_status_name, $this->session->userdata('username'));

			$id_application_status_name = '17';

			/*
			..INSERT application_status Table..
			*/
			$app_status = array(
	            'id_application '=> $id_application,
	            'id_application_status_name' => $id_application_status_name,
	            'process_status' => 'PENDING',	
	            'created_date' => $this->date_time_now(),
	            'created_by' => $this->session->userdata('username')
	    	);
			

						echo "|KEYS :".json_encode($keys);
						echo "|APP_STATUS :".json_encode($app_status);

	        $inserted_id = $this->user_model->insert_app_status($app_status);


						echo "|KEYS :".$inserted_id;

			// $app_file = array();
			foreach ($uploaded as $index => $valIndex) {
				# code...
				// echo "| index : {$index}";
				// echo "| list_id_form_mapping : {$list_id_form_mapping[$index]}";

				/*
				Insert application_file Table
				@Insert New Files Uploaded by User
				*/
				$app_file =  array(
					// 'id_document_config' => $query[$index]->id_document_config,
					'id_document_config' => $keys[$index],
					'id_application' =>	 $id_application,
					'path_id' => $uploaded[$index]['full_path'],
					'status' => 'ACTIVE',
		            'created_date' => $this->date_time_now(),
					'created_by' => $this->session->userdata('username')
				);
						echo "|APP_FILE :".json_encode($app_file);
				$this->user_model->insert_app_file($app_file);

				$form_map = array(
					'id_application_status' => $inserted_id,
					'type' => 'REVISION_ASSESSMENT_FILE',
					'value' => $keys[$index],
		            'created_date' => $this->date_time_now(),
					'created_by' => $this->session->userdata('username')
				);


				echo "|FORM_MAP :".json_encode($form_map);
				$this->user_model->set_app_form($form_map);

				// foreach ($valIndex as $key => $val) {
					# code...

					/*
					Validate $key== id_document_config
					*/
					// if ($key == 'id_document_config') {
					// 	$app_file['id_document_config'] = $val;
					// }

					/*
					Validate $key== key
					*/
					// if ($key == 'key') {
						/*
						Insert application_status_form_mapping Table
						@Insert KEY of revision Files Uploaded by User
						*/
						
						// 


						/*
						..INSERT log Table..
						*/
						// $this->log("Revision Document Assessment Verification","Revision Document Assessment Submitted by");
					// }
				// }


			}
			$this->log("Revision Document Assessment Verification","Revision Document Assessment Submitted by");
			
			// echo "|".json_encode($app_file);
		}


	}

	// public function step_8($uploaded, $key){

	// }

	// public function step_9($uploaded, $key){

	// }


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
			$this->log("New Application Closed","Application Closed by");

			echo "|process_status_updated : COMPLETED";
		}

		// redirect(base_url());
	}


	// public function insert_letter_submission() {
		
	// 	$a = $this->session->userdata('status');
	// 	echo $a."\r";
	// 	// echo base_url()."\r";
	// 	// echo base_url(TRUE, TRUE, TRUE)."\r";
	// 	// redirect(base_url().'SipinHome',refresh);
	// 	// redirect(base_url("SipinHome/submitiin"));




	// 	if($this->session->userdata('status') != "login"){
	// 		redirect(base_url(""));
	// 	} else {

	// 		// $this->SipinHome->captcha();
	// 		/*Validasi apakah ada applikasi yang status nya OPEN*/
	// 		// if ($a == '1') {

	// 			echo "|security_code : {$this->input->post('security_code')}|mycaptcha : {$this->session->userdata('mycaptcha')}";

	// 			echo "$ {$this->input->post('batal')} $";

	// 			if($this->input->post('kirim')  == 'kirim') {

	// 				$id_user = $this->session->userdata('id_user');
	// 				$get_document = $this->user_model->get_applications_Status($id_user);
	// 				$username = $this->session->userdata('username');

	// 				if (($this->input->post('security_code') == $this->session->userdata('mycaptcha'))){
						
	// 					$data = array(
	// 					'id_user' => $id_user,


	// 					/*id_admin yg update nanti dari sisi admin makanya di isi Null*/ 
	// 					// 'id_admin' => "NULL",
	// 					// 'applicant' => $this->session->userdata('username'),
	// 					// 'applicant_phone_number' => "085725725725",


	// 					'applicant' => $this->input->post('app_applicant'),
	// 					'applicant_phone_number' => $this->input->post('app_no_applicant'),
	// 					'application_date' => $this->input->post('app_date'),
	// 					'instance_name' => $this->input->post('app_instance'),
	// 					'instance_email' => $this->input->post('app_mail'),
	// 					'instance_phone' => $this->input->post('app_phone'),
	// 					'instance_director' => $this->input->post('app_div'),
	// 					'mailing_location' => $this->input->post('app_address'),
	// 					'mailing_number' => $this->input->post('app_num'),
	// 					'iin_status' => "OPEN",
	// 					'application_type' => "New",
	// 					'created_date' => date('Y-m-j H:i:s'),
	// 					'created_by' => $username,
	// 					'modified_date' => date('Y-m-j H:i:s'),
	// 					'modified_by' =>$username);

	// 					/*
	// 					AUDIT TRAIL Step 1
	// 					*/
	// 					$this->log("added new application","Created new application");
	// 			        /*Insert Pengajuan*/
	// 					$a = $this->user_model->insert_pengajuan($data);



	// 					/*insert Status 1 Pending*/
	// 					if ($get_document->num_rows() > 0){
	// 						echo "|inserted_id : {$a}|num rows : {$get_document->num_rows()}";
	// 							$data1 = array(
	// 			                // 'id_application '=> $get_document->row()->id_application,
	// 			                'id_application '=> $a,
	// 			                'id_application_status_name' => '1',
	// 			                'process_status' => 'PENDING',	
	// 			                'created_date' => date('Y-m-j'),
	// 			                'created_by' => $username,
	// 			                'modified_by' => $username,
	// 			                'last_updated_date' => date('Y-m-j'));
	// 			            $this->user_model->insert_app_status($data1);
						
	// 			            /*
	// 			            	REMINDER : 
	// 			            	At this point , user should be stuck in this page
	// 							and waiting for admin verification
	// 			            */
	// 						// redirect(base_url().'SipinHome',refresh);

	// 					}
	// 				} else {
	// 					$this->session->set_flashdata('validasi-captcha', 'Captcha tidak sesuai');
	// 					echo "Tidak Sama";
	// 					// redirect(base_url().'SipinHome',refresh);
	// 					// redirect(base_url("SipinHome/submitiin/"));
	// 				}
	// 			} else {
	// 				echo "Dibatalkan";
	// 					// redirect(base_url(""));
	// 					// redirect(base_url().'SipinHome',refresh);
	// 			}
	// 		// } else {

	// 		// }

	// 	}
	// }


	/*Melakukan penarikan dokumen*/
	public function download(){
	
	if($this->session->userdata('status') != "login"){
			redirect(base_url("SipinHome"));
		}

	$image_id = $this->input->get('var1');
   		force_download($image_id, NULL);	
	}

	// public function download_iin_doc($image_id){
	
	// 	if($this->session->userdata('status') != "login"){
	// 			redirect(base_url("SipinHome"));
	// 		}

	// 	$image_id = $this->input->get('var1');
	//    		force_download($image_id, NULL);	
	// }


	// function  step_tiga_upload (){
	// 	$id_user = $this->session->userdata('id_user');
	// 	$get_status = $this->user_model->get_applications_Status($id_user);
	// 	$id_app = $this->user_model->get_aplication($id_user);
	// 	$username = $this->session->userdata('username');
	// 	/*insert Status*/
	// 	// if ($get_document->num_rows() > 0){
		
	// 	if ($get_status->row()->id_application_status_name =="4"){
	// 			if ($get_status->row()->id_application_status_name =="PENDING"){
	// 				$this->log("Revisi document","Revisi step3");
	// 				$this->user_model->update_aplication_status("COMPLETED", $get_status->row()->id_application, "4", $username);
	// 				$data5 = array(
 //                'id_application '=> $get_status->row()->id_application,
 //                'id_application_status_name' => '5',
 //                'process_status' => 'PENDING',
 //                'created_date' => date('Y-m-j'),
 //                'created_by' => $username,
 //                'modified_by' => $username,
 //                'modified_date' => date('Y-m-j'));
 //                $this->user_model->insert_app_status($data5);
	// 			}
	// 	} 
	// 	else {
	// 		// if  ($get_status->row()->id_application_status_name =="3"){ 

	// 		$data1 = array(
 //                'id_application '=> $id_app->row()->id_application,
 //                'id_application_status_name' => '3',
 //                'process_status' => 'PENDING',	
 //                'created_date' => date('Y-m-j'),
 //                'created_by' => $username,
 //                'modified_by' => $username,
 //                'modified_date' => date('Y-m-j'));
 //            $this->user_model->insert_app_status($data1);

	// 	}

	// }


	// function  step_enam_upload (){
	// $id_user = $this->session->userdata('id_user');
	// $get_status  = $this->user_model->get_applications_Status($id_user);
	// $username = $this->session->userdata('username');
	// 	 /*insert Status*/
	// 	if ($get_status->num_rows() > 0){

	// 		$this->user_model->update_aplication_status("COMPLETED", $get_status->row()->id_application, "7", $username);
		
	// 			$this->log("Upload new document","Upload new document step6");
	// 			$data3 = array(
 //                'id_application '=> $get_status->row()->id_application,
 //                'id_application_status_name' => '9',
 //                'process_status' => 'PENDING',
 //                'created_date' => date('Y-m-j'),
 //                'created_by' => $username,
 //                'modified_by' => $username,
 //                'last_updated_date' => date('Y-m-j'));
 //                $this->user_model->insert_app_status($data3);
                     
 //            // 7 Belum dirubah jadi update
	// 	}
	// }
	
	// function  step_tujuh_team (){
	// 	$id_user = $this->session->userdata('id_user');
	// 	$get_status  = $this->user_model->get_applications_Status($id_user);
	// 	$username = $this->session->userdata('username');
	// 	 /*insert Status*/
	// 	if ($get_status->num_rows() > 0){
		
	// 		$this->log("Upload confirmation payment","Upload nconfirmation payment");
	// 		$data3 = array(
 //            'id_application '=> $get_status->row()->id_application,
 //            'id_application_status_name' => '14',
 //            'process_status' => 'PENDING',
 //            'created_date' => date('Y-m-j'),
 //            'created_by' => $username,
 //            'modified_by' => $username,
 //            'last_updated_date' => date('Y-m-j'));
 //            $this->user_model->insert_app_status($data3);
	// 		$this->user_model->update_aplication_status("COMPLETED", $get_status->row->id_application, "12", $username);
			
	// 	}
	// }



	/*Melakukan Upload document*/
	function upload_files_assessment() {
		// echo "|id_application_status : {$this->session->userdata('id_application_status')}";
		//STEP 7

		if($this->session->userdata('status') != "login"){
			redirect(base_url("SipinHome"));
		}
		
		// Configure upload.
	 	$this->load->library('upload');
		$this->upload->initialize(array(
			 "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
             "upload_path"   => "./upload/"
		));

		$id_application = $this->session->userdata('id_application');
		$id_application_status = $this->session->userdata('id_application_status');
		echo "|ID APP : {$id_application}";
		echo "|ID APP ST: {$id_application_status}";

		// $prev_id_app_status_name = "16";
		// $query = $this->user_model->id_application_status_step_n($id_application, $prev_id_app_status_name);
		// 	echo "query : ".json_encode($query);


		// $id_application_status_step7 = "";
		// foreach ($query as $key => $value) {
		// 	# code...
		// 	$id_application_status_step7 = $value->id_application_status;
		// }


		// $id_application_status = $this->session->userdata('id_application_status');



		$type='REV_DOC_ASM';
		$val = $this->user_model->get_form_mapping_by_type($id_application_status, $type);



		// echo "|TEST : {$id_application_status}";

		echo "|val : ".json_encode($val);

		$key3_arr = array();
		foreach ($val as $index => $valIndex) {

			switch($valIndex->type){

				case "REV_DOC_ASM": 					
					array_push($key3_arr, $valIndex->value);
					break;	 

			}

		}


		// echo "|key3_arr : ".json_encode($key3_arr);
		// echo "|key3_arr sizeof() : ".sizeof($key3_arr);

		$uploaded = array();
		$key = array();


		for ($i = 0; $i < sizeof($key3_arr); $i++) {
			echo "|TEST {$i}";

			/*
			Define index of list file from View
			*/

			$usr_file = "file{$i}";

			/*
			File name
			*/
			$name_file = $_FILES[$usr_file]['name'];
			// echo " {$name_file}";

			/*
			Validate if the file name empty
			@ In this case only upload file that already selected by user.
			@ If user didn't choose a file, error from My_upload will be 'You did not selected the file'
			*
			*/
			if ( $name_file != "") {
				$this->upload->do_upload($usr_file);
				echo "|IN : {$usr_file}";
				echo " {$name_file}";


				// $uploaded = $this->upload->data();
				array_push($uploaded, $this->upload->data());
				array_push($key, $key3_arr[$i]);
			} else {
				echo "|ERR : {$usr_file}";
			}
					

		}

		echo "|uploaded : ".json_encode($uploaded);
		// echo "|key : ".json_encode($key);

		if ($this->input->post('upload') == "uploadstep7") {
			$this->step_7($uploaded, $key3_arr);
		}

		// redirect(base_url("Layanan-IIN"),'refresh');
	}



	function upload_files() {

		if($this->session->userdata('status') != "login"){
			redirect(base_url("SipinHome"));
		}

		$id_user = $this->session->userdata('id_user');
		$get_document = $this->user_model->get_aplication($id_user);
		$username = $this->session->userdata('username');
		$query = 0;

      	// Configure upload.
	 	$this->load->library('upload');
		$this->upload->initialize(array(
			 "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
             "upload_path"   => "./upload/"
		));

		/*
		To Count List of files to be uploaded (if it isn't an array)
		*
		*/

		//STEP 5
		$no_count = $this->input->post('no_count');
		echo "|no_count : {$no_count}";

		$explode_str = explode(",", $no_count);	

		$key2 = $this->input->post('key_step5');
		echo "|key2 : {$key2}";

		$key2_arr = array($key2);

		echo "|key2_arr : ".$key2_arr[0];

		
		


		/*
		Instantiate uploaded and key files array.
		*/

		$uploaded = array();
		$key = array();


		for ($i = 0; $i < count($explode_str); $i++) {
			echo "|TEST {$i}";

			/*
			Define index of list file from View
			*/

			$usr_file = "file{$explode_str[$i]}";

			// $usr_file = "file{$i}";
			// echo "|{$usr_file}";

			/*
			File name
			*/
			$name_file = $_FILES[$usr_file]['name'];
			// echo " {$name_file}";

			/*
			Validate if the file name empty
			@ In this case only upload file that already selected by user.
			@ If user didn't choose a file, error from My_upload will be 'You did not selected the file'
			*
			*/
			if ( $name_file != "") {
				$this->upload->do_upload($usr_file);
				echo "|IN : {$usr_file}";
				echo " {$name_file}";


				// $uploaded = $this->upload->data();
				array_push($uploaded, $this->upload->data());
				array_push($key, $explode_str[$i]);
			} else {
				echo "|ERR : {$usr_file}";
			}

		}

		
		// echo "|uploaded : ".json_encode($uploaded);
		// echo "|key : ".json_encode($key);

		if ($this->input->post('upload') == "uploadstep3"){
			$this->step_2($uploaded, $key);
		} 
		else if ($this->input->post('upload') == "uploadstep5") {
			 $this->step_5($uploaded, $key2_arr);
		} 

		redirect(base_url("Layanan-IIN"),'refresh');

	}
	
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
			for ($j = 0; $j < count($query); $j++) {
			   	/*Array Image di parsing*/
				for ($i = 0; $i < count($uploaded); $i++) {
					/*Disamain Indexnnya Setelah Index Sama Baru di Insert ke DB*/
				 	if ($j == $i) {
			 			/*Query Insert FilePathnya ke DB*/
						if ($this->input->post('upload') == "uploadstep6") {
							$this->user_model->update_document( $query[$j]->id_application, $query[$j]->id_application_file, $query[$j]->id_document_config, $uploaded['full_path'], $username);
						} else if ($this->input->post('upload') == "uploadstep3") {
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
		} else {
			die('GAGAL UPLOAD');
  		} 
 
		if ($this->input->post('upload') == "uploadstep3"){
			$this->step_tiga_upload();
		} 
		else if ($this->input->post('upload') == "uploadstep6") {
			 $this->step_enam_upload();
		}
	} 
 
	function download_iin() {

		$id_user = $this->session->userdata('id_user');
		// echo "|TYPEHERE : {$}";
		// echo "|TYPEHERE : ".;

		/*
		Check Survey Status
		@ Valid if survey_status = 0
		*/
		$survey_status = $this->session->userdata('survey_status');
		if ($survey_status == '0') {
			echo "|SURVEY STATUS : {$survey_status}";

			/*
			DOWNLOAD IIN document
			@ Valid if survey_status = 0
			*/
			// $image_id = $this->input->get('var1');
			// echo "|IMAGE ID : {$image_id}";
			// $this->download();

		}


		//check survey status
		//first time open survey tab
		// on survey completed update survey status and directly download IIN
		//logging


	}


	function pengawasan() {
		//login (check already have IIN?)

		//auto populate step 1
		//insert data application ttable applications 
		

		//jump to step 3 (start from step 3)
	}















	// ALDY SOURCE CODE
	//SURVEY

	public function set_template($view_name, $data = array()){
        $this->load->view('header', $data);
        $this->load->view($view_name, $data);
        $this->load->view('footer', $data);
        return;
    }


	public function survey( $x = null){
		switch ($x) {
			case 'vote':
				$survey = $this->user_model->survey('vote',null)->result_array();
				$data['survey'] = $survey[0]['id_survey_question'];
				$data['data'] = json_decode($survey['0']['question'], true);
				$this->set_template('survey',$data);
				break;

			case 'insert-survey';
				$survey_config 	 = explode('|', $this->input->post('survey'));
				$survey_question = array();
				for ($i=1; $i <= $survey_config[1] ; $i++) { 
					$answer = array(
		                'no'   		=> $i,
		                'type'   	=> $this->input->post('answer'.$i) ? 'RATING': "COMMENT",
		                'answer'   	=> $this->input->post('answer'.$i) ? $this->input->post('answer'.$i) : $this->input->post('comment'.$i)
		                );
					array_push($survey_question, $answer);
				}

				$survey_answers = array(
		                'id_user'   		=> $this->session->userdata('id_user'),
		                'answer'   			=> json_encode($survey_question),
		                'version'   		=> $survey_config[0],
		                'created_date'		=> $this->date_time_now(),
		                'created_by'		=> $this->session->userdata('username')
		                );

				// Masukan $survey_answers ke database
				// Hapus echo dibawah
				// function model sudah dibuat 
				echo json_encode($survey_answers);
				break;
			case 'result-survey';
				// KALAU SUDAH MEMBUAT QUERY YANG JIKA DI json_encode seperti dibawah
				// HAPUS CODE DIBAWAH INI
				$data['survey'] = json_decode('{"id_survey_question":"1","version":"1","total_answer":"15","survey_questions":[{"no":"1","question":"Question number 1","average":"4","answer":{"1":"0","2":"0","3":"3","4":"3","5":"9"}},{"no":"2","question":"Question number 2","average":"4","answer":{"1":"0","2":"0","3":"3","4":"3","5":"9"}}]}',true);
				// SAMPAI CODE INI

				// LALU HAPUS COMMENT CODE DIBAWAH INI
				// $data['survey'] = $this->user_model->get-survey-result()->result_array();

				$this->set_template('survey-result',$data);
				break;
			default:
				redirect(base_url());
				break;
		}

	}
}