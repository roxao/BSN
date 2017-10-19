<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SipinHome extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->library('session');
	   	$this->load->helper(array('captcha','url','form','download'));
		$this->load->model('user_model');
		$this->load->library('email','form_validation', 'curl');
		$this->model = $this->user_model;
        $this->load->database();
        $this->load->model('admin_model','adm_model');
	}
 
	public function index() {		
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
		$this->captcha();
	}

	public function captcha() {

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

	// ALDY: FILE ISO
	// public function iso_document(){ 
	public function file_iso_7812() {		
		// $data['file_iso'] = 'http://localhost:8090/BSN/assets/sample.pdf';
		$data['file_iso'] = $this->user_model->get_file_iso()->result();

		// echo json_encode($dat);
		$this->load->view('header');
		$this->load->view('iso-document-view', $data);
		// $this->load->view('footer');
	}

	// ALDY: LOGIN USER
	public function user($param) {
		$data['type']=$param;
		$message = $this->session->flashdata('validasi-login');
		$data['message']=$message;
		$this->load->view('login', $data);
	}


	/*
	Insert Log Function
	@array dataLog
	@var detail_log
	@var log_type
	@var created_date
	@var created_by
	*/
	public function log($Type, $detil, $username) {
		$dataLog = array(
                'detail_log' => $username. $detil,
                'log_type' => $Type .$username, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $username,
                'last_update_date' => date('Y-m-j H:i:s'),
                'modified_by' => date('Y-m-j H:i:s'),
                );
        $this->user_model->insert_log($dataLog);
	}

	/* User login function. */
	//  public function login() {

	 	
 //     $username = $this->input->post('username');
 //     $password = hash ( "sha256", $this->input->post('password'));

	//  echo $password;
 //     // $password =  $this->input->post('password');
 //     $cek = $this->user_model->cek_login($username, $password);
 //     if($cek->num_rows() > 0){
 //     if ($cek->row()->status_user == 0) { $this->session->set_flashdata('validasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');
 //  $this->user('login');}
 //      else {$this->session->set_flashdata('validasi-login', 'Selamat Datang');
 //      $this->log("login","Login", $username);
 //      $id_user = $this->session->userdata('id_user');

 //      $cek_menu= $this->user_model->get_aplication($id_user);

 //      $this->session->set_userdata(array(
	//     'id_user'  		=> $cek->row()->id_user,
	//     'username' 		=> $cek->row()->username,
	//     'email' 		=> $cek->row()->email,
	//     'status_user'   => $cek->row()->status_user,
	//     'status' => "login",
	// 	));

 //  //    	$this->load->view('header');
	// 	// $this->load->view('home');
	// 	// $this->load->view('footer');
 //      redirect(base_url("SipinHome"));
	// }
 //      }else{
	// $this->session->set_flashdata('validasi-login', 'Username/Password yang anda masukkan salah');
	// $this->user('login');
	// 	}
 //      }



    public function logout() {	
      	$username = $this->session->userdata('username');
      	$this->log("logout","logout", $username);
		$this->session->sess_destroy();	
		redirect(base_url("SipinHome"));
	}

	/* 
	Register function. 
	@function captcha()
	@var name
	@var username
	@var no_iin
	@var email
	@var password
	@var password_confirm
	
	*/
	public function register() {
		/*
		Password Validation
		*/
		$regex = $this->regex($this->input->post('password'));
		if ($regex == "true"){

			$name = $this->input->post('fullname');
			$username = $this->input->post('username');
			$no_iin    = $this->input->post('iin-number');
			$email    = $this->input->post('email');
			$password = hash ( "sha256", $this->input->post('password'));
			$password_confirm = hash ( "sha256", $this->input->post('retype-password'));
			
			/*
			Captcha Validation
			*/
			if (($this->input->post('security_code') == $this->session->userdata('mycaptcha'))){
				if ($password == $password_confirm){

					/*
					User Status Validation
					*/		
					$cek = $this->user_model->cek_status_user($username);
			        if($cek->num_rows() > 0){
		        		$this->session->set_flashdata('validasi-login', 'Username/Email sudah terdaftar');
		  				$this->user('register');
			    	} else {
			    		if ($this->user_model->register_user($email ,$username, $password, $name)){
							if ($this->user_model->sendMail($email,$username, "Please click on the below activation link to verify your email address.")) {
					
								$this->session->set_flashdata('validasi-login', 'Anda berhasil melakukan registrasi, silahkan periksa pesan masuk email Anda, untuk mengaktifkan akun yang telah Anda buat');
								$this->log("login","Login", $username);
								$this->user('register');

						    } else {
						    	// echo  "Gagal";
								$this->session->set_flashdata('validasi-login', 'Gagal melakukan registrasi');
								$this->user('register'); 
							}
						}
					}
				} else { 
					$this->captcha();
					$this->session->set_flashdata('validasi-login', 'password yang anda masukkan tidak sesuai');
					$this->user('register');}	
			} else {
				$this->captcha();
				$this->session->set_flashdata('validasi-login', 'Captcha tidak sesuai');
				$this->user('register');
			}	
		} else {
			$this->captcha();
			$this->session->set_flashdata('validasi-login', 'Password minimal 8 karakter dan harus huruf besar, huruf kecil, angka, dan special character (Contoh : aAz123@#');
			// $this->user('register');
			redirect(base_url('user/register'));
		}
	}

	/*
	Forgot Password
	@var username_forgot
	@cek username_forgot
	@model user_model
	*/
	public function forgot_password() {
		$username_forgot = $this->input->post('E-mail');

		$cek = $this->user_model->forgot_password($username_forgot);
		if ($cek->num_rows() > 0){
		if ($this->user_model->sendMail($cek->row()->email, $cek->row()->name,"Please click on the below activation link to verify your email address.")) {
			$this->log("login","Login", $username_forgot );
			$this->session->set_flashdata('validasi-login', 'Berhasil melakukan reset password silahkan cek email anda');
			$this->user('forgot');
		}else {
			$this->session->set_flashdata('validasi-login', 'Gagal melakukan reset password');
			$this->user('forgot');} 
		} else {$this->session->set_flashdata('validasi-login', 'Username/Email tidak ditemukan');
			$this->user('forgot'); 
		} 
	}


	/*
	Verifying User Activation Link
	@var link
	@array link_array 
	@var enc
	@model user_model
		@function verifyEmail
	*/
  	public function verify() {
		$link = $_SERVER['REQUEST_URI'];
    	$link_array = explode('/',$link);
    	$enc = end($link_array);

    	/*Calling user_model->verifyEmail to verify activation link*/
    	$this->user_model->verifyEmail($enc);

        /*Get Registration Message on Current Session*/
	 	echo $this->session->flashdata('regis_msg');
		redirect(base_url("SipinHome"));
  	}


  	/*Regex validasi karakter password*/
	public function regex($password){
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialcaracter    = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password);
		if(!$uppercase || !$lowercase || !$number || !$specialcaracter || strlen($password) < 8) {
			return false;
		} else {
			return true;
		}
	}

	// public function submitiin () {
	// 	// $this->captcha();
	// 	$id_user = $this->session->userdata('id_user');
	// 	$Status =  $this->user_model->get_applications_Status($id_user);
	// 	// echo $Status->row()->id_application_status_name ;
	// 	// $this->session->set_flashdata('satu', "PENDING");
	// 	$this->session->set_flashdata('satu', "PENDING");
	// 	if ($Status->num_rows() > 0){
		
	// 		switch ($Status->row()->id_application_status_name) {
	//             case '1':
	//             if ($Status->row()->process_status == "COMPLETED"){
	// 				$this->session->set_flashdata('satu', "COMPLETED");
	// 				$this->session->set_flashdata('dua', "PENDING");
	//             } else if ($Status->row()->process_status == "PENDING"){
	// 				$this->session->set_flashdata('satu', "PENDING");
	//             } 
	            
	//                break;
	//             case '2':
	//             if ($Status->row()->process_status == "COMPLETED"){
	// 				$this->session->set_flashdata('dua', "COMPLETED");
	// 				$this->session->set_flashdata('tiga', "PENDING");
	//             } else if ($Status->row()->process_status == "PENDING"){
	// 				$this->session->set_flashdata('dua', "PENDING");
	//             } else{
	//             	$this->session->set_flashdata('dua', "");
	//             }
	//                 break;
	//             case '3':
	// 			if ($Status->row()->process_status == "COMPLETED"){
	// 				$this->session->set_flashdata('tiga', "COMPLETED");
	//             } else if ($Status->row()->process_status == "PENDING"){
	// 				$this->session->set_flashdata('tiga', "PENDING");
	//             } else{
	//             	$this->session->set_flashdata('tiga', "");
	//             }

	//             case '4':
	//             $this->session->set_flashdata('empat', $Status->row()->process_status);
	//             	break;
	//             case '5':
	//             $this->session->set_flashdata('lima', $Status->row()->process_status);
	//             	 break;
	//             case '6':
	//                  $this->session->set_flashdata('enam', $Status->row()->process_status);
	//                 break;
	//             case '7':
	//                  $this->session->set_flashdata('tujuh', $Status->row()->process_status);
	//                 break;
	//             case '8':
	//                  $this->session->set_flashdata('delapan', $Status->row()->process_status);
	//                 break;
	//             case '9':
	//                  $this->session->set_flashdata('sembilan', $Status->row()->process_status);
	//                 break;
	//             case '10':
	//             $this->session->set_flashdata('sepuluh', $Status->row()->process_status);
	//                break;
	//             case '11':
	//             $this->session->set_flashdata('sebelas', $Status->row()->process_status);
	//                 break;
	//             case '12':
	//             $this->session->set_flashdata('duabelas', $Status->row()->process_status);
	//                 break;
	//             case '13':
	//             $this->session->set_flashdata('tigabelas', $Status->row()->process_status);
	//             	break;
	//             case '14':
	//             $this->session->set_flashdata('empatbelas', $Status->row()->process_status);
	//             	 break;
	//             case '15':
	//                  $this->session->set_flashdata('limabelas', $Status->row()->process_status);
	//                 break;
	//             case '16':
	//                  $this->session->set_flashdata('enambelas', $Status->row()->process_status);
	//                 break;
	//             case '17':
	//                  $this->session->set_flashdata('tujuhbelas', $Status->row()->process_status);
	//                 break;
	//             case '18':
	//                  $this->session->set_flashdata('delapanbelas', $Status->row()->process_status);
	//                 break;
	//             case '19':
	//                  $this->session->set_flashdata('sembilanbelas', $Status->row()->process_status);
	//                 break;
	//         }
 //        }

	// 	$this->load->view('header');
	// 	$this->load->view('submit-iin');
	// 	$this->load->view('footer');	
	// }



	/*
	Login Function
	@var username
	@var password
	*/
    public function login() {

	    $username = $this->input->post('username');
	    $password = hash ( "sha256", $this->input->post('password'));

	    /*
	    Validate User Login
	    */
	    $cek = $this->user_model->cek_login($username, $password);

    	echo json_encode($cek->result_array());

	    // if($cek->num_rows() > 0){
    	if (!is_null($cek->row()->status_user)) {
	    	// echo '|'.$cek->row()->status_user.'|'.$cek->row()->username;
		    if ($cek->row()->status_user == 0){ 
		     	$this->session->set_flashdata('validasi-login', 'Anda belum melakukan Aktivasi silahkan lakukan aktivasi');
				$this->user('login');
			} else {

				/*
				Already have IIN
				*/
				if (empty($cek->row()->iin_number)) {
					echo "|Do not have IIN|";
					$have_iin = "N";
				} else {
					echo "|Already have IIN|";
					$have_iin = "Y";
				}

				//date_default_timezone_get()
				$this->session->set_flashdata('validasi-login', 'Selamat Datang');
				$this->log("login","Login", $username);
				$id_user = $this->session->userdata('id_user');

				// $cek_menu= $this->user_model->get_aplication($id_user);

				$this->session->set_userdata(array(
					'id_user'  		=> $cek->row()->id_user,
					'username' 		=> $cek->row()->username,
					'email' 		=> $cek->row()->email,
					'status_user'   => $cek->row()->status_user,
					'status' => "login",
					'have_iin' => $have_iin
				));

				/*
				Any Open Application?
				*/
				if ($cek->row()->iin_status == 'OPEN') {
					echo "|Active application|";

					/*
					Application Type?
					*/
					$this->session->set_userdata('application_type',$cek->row()->application_type);
					echo "|TEST : {$this->session->userdata('application_type')}|";

					if ($cek->row()->application_type == 'New') {
						echo "|{$cek->row()->application_type}|";

						$url = "";
						redirect(base_url("SipinHome/submit_application/{$url}"));

					} else {
						echo "|{$cek->row()->application_type}|";
						// redirect(base_url('extend'));
						redirect(base_url("SipinHome/submit_application/", $base_url));
					}

				} else {
					echo "|NO active application|";
					redirect(base_url());
				}

			}
			
		} else {
		    $this->session->set_flashdata('validasi-login', 'Username/Password yang anda masukkan salah');
		    // $this->user('login');
		    redirect(base_url("user/login"));
		}
    }

	/*
	Render submit-iin page
	@var id_user
	@var get_app_status
	@var iin_status
	@var id_application_status_name
	@var process_status
	*/
	public function submit_application(){

		$id_user = $this->session->userdata('id_user');;

		/*
		Get Application Status
		*/
		$get_app_status =  $this->user_model->get_applications_Status($id_user);
		$iin_status = $get_app_status->row()->iin_status;

		// if ($get_app_status->num_rows() > 0){
		// if ($iin_status == "OPEN"){

		$id_application_status_name = $get_app_status->row()->id_application_status_name;
		$process_status = $get_app_status->row()->process_status;

		// echo 
		// "
		// |id_user : {$id_user}|
		// id_application_status_name :  {$id_application_status_name}|
		// process_status :  {$process_status}|
		// iin_status :  {$iin_status}|
		// <br>";

		$page = '0';

		$id_application_status_name = '19';
		// $process_status = "PENDING";
		// $process_status = "PENDING";

		if ( $id_application_status_name >= '1' )
			$page = '1';
		if ( $id_application_status_name >= '3' )
			$page = '2';

		//STEP 3 should be validated by button from step 2
		
		if ( $id_application_status_name == '6' or $id_application_status_name == '8' or $id_application_status_name == '9' )
			$page = '4';
		if ( $id_application_status_name == '7' or $id_application_status_name == '10' or $id_application_status_name == '11')
			$page = '5';
		if ( $id_application_status_name >= '12' )
			$page = '6';
		if ( $id_application_status_name >= '14' )
			$page = '7';
		if ( $id_application_status_name >= '16' )
			$page = '8';
		if ( $id_application_status_name == '19' )
			$page = '9';

		$box_string_array = array();
		$box_status_array = array();
		for ($i = 0; $i <= 9; $i++) {
			

			$string_status = "box_status_";
			$string_status .= $i;
			array_push($box_string_array, $string_status );
			

			// echo "<br>page : {$page}";


			if ($i == $page) {
				array_push($box_status_array, "PENDING" );
			} else if ($i < $page){
				array_push($box_status_array, "COMPLETED" );
			} else {
				array_push($box_status_array, "" );
			}

			// print_r($box_array);
		}

		/*
		Passing $data from Controller to View
		*/
		$data = array_combine($box_string_array, $box_status_array);
		

		$this->load->view('header');
		$this->load->view('submit-iin',$data);
		$this->load->view('footer');

	}

		// if ($status->num_rows() > 0){
			


		// 	switch ($status->row()->id_application_status_name) {
	 //            case '1':




		//             if ($status->row()->process_status == "COMPLETED"){
		// 				$this->session->set_flashdata('satu', "COMPLETED");
		// 				$this->session->set_flashdata('dua', "PENDING");
		//             } else if ($status->row()->process_status == "PENDING"){
		// 				$this->session->set_flashdata('satu', "PENDING");
		//             } 
	            
	 //            break;
	 //            case '2':
	 //            if ($status->row()->process_status == "COMPLETED"){
		// 			$this->session->set_flashdata('dua', "COMPLETED");
		// 			$this->session->set_flashdata('tiga', "PENDING");
	 //            } else if ($Status->row()->process_status == "PENDING"){
		// 			$this->session->set_flashdata('dua', "PENDING");
	 //            } else{
	 //            	$this->session->set_flashdata('dua', "");
	 //            }
	 //                break;
	 //            case '3':
		// 		if ($status->row()->process_status == "COMPLETED"){
		// 			$this->session->set_flashdata('tiga', "COMPLETED");
	 //            } else if ($Status->row()->process_status == "PENDING"){
		// 			$this->session->set_flashdata('tiga', "PENDING");
	 //            } else{
	 //            	$this->session->set_flashdata('tiga', "");
	 //            }

	 //            case '4':
	 //            $this->session->set_flashdata('empat', $Status->row()->process_status);
	 //            	break;
	 //            case '5':
	 //            $this->session->set_flashdata('lima', $Status->row()->process_status);
	 //            	 break;
	 //            case '6':
	 //                 $this->session->set_flashdata('enam', $Status->row()->process_status);
	 //                break;
	 //            case '7':
	 //                 $this->session->set_flashdata('tujuh', $Status->row()->process_status);
	 //                break;
	 //            case '8':
	 //                 $this->session->set_flashdata('delapan', $Status->row()->process_status);
	 //                break;
	 //            case '9':
	 //                 $this->session->set_flashdata('sembilan', $Status->row()->process_status);
	 //                break;
	 //            case '10':
	 //            $this->session->set_flashdata('sepuluh', $Status->row()->process_status);
	 //               break;
	 //            case '11':
	 //            $this->session->set_flashdata('sebelas', $Status->row()->process_status);
	 //                break;
	 //            case '12':
	 //            $this->session->set_flashdata('duabelas', $Status->row()->process_status);
	 //                break;
	 //            case '13':
	 //            $this->session->set_flashdata('tigabelas', $Status->row()->process_status);
	 //            	break;
	 //            case '14':
	 //            $this->session->set_flashdata('empatbelas', $Status->row()->process_status);
	 //            	 break;
	 //            case '15':
	 //                 $this->session->set_flashdata('limabelas', $Status->row()->process_status);
	 //                break;
	 //            case '16':
	 //                 $this->session->set_flashdata('enambelas', $Status->row()->process_status);
	 //                break;
	 //            case '17':
	 //                 $this->session->set_flashdata('tujuhbelas', $Status->row()->process_status);
	 //                break;
	 //            case '18':
	 //                 $this->session->set_flashdata('delapanbelas', $Status->row()->process_status);
	 //                break;
	 //            case '19':
	 //                 $this->session->set_flashdata('sembilanbelas', $Status->row()->process_status);
	 //                break;

	            
	 //        }
  //       }

	

	public function modal_popup(){
		$this->load->view('component/modal_popup');
	}

	public function contact_us()
	{
		$this->load->view('header');
		$this->load->view('contact-us');
		$this->load->view('footer');
		
	}

	public function send_complaint()
	{
		$cek = $this->user_model->get_user_by_prm($this->input->post('email'),$this->input->post('name'));
		
		$data = array(
                'id_user' => $cek->row()->id_user,
                'complaint_details' => $this->input->post('message'),
                'created_date' => date('Y-m-j'),
                'created_by' => $this->input->post('name'));
		// echo json_encode($data);
		$this->user_model->insert_complain($data);

		redirect(base_url('contact-us'));

	}

	public function cms_post($prm){
		$data['cms'] = $this->adm_model->get_cms_by_prm($prm)->result_array();
		$this->load->view('header');
		$this->load->view('cms-post-view',$data);
		$this->load->view('footer');
	}

	public function contact_us_prossess(){	
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$message = $this->input->post('message');
		$this->user_model->sendMail($email,$name, $message);
		redirect(base_url('contact-us'));
	}

	public function iin_list(){
		$data['iin'] = $this->user_model->get_iin()->result();
		$this->load->view('header');
		$this->load->view('iin-list-view',$data);
		$this->load->view('footer');
	}
 }
