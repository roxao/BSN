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
 
	public function index(){		
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
		$this->captcha();
	}


	// ALDY: FILE ISO
	// public function iso_document(){ 
	public function file_iso_7812(){		
		// $data['file_iso'] = 'http://localhost:8090/BSN/assets/sample.pdf';
		$data['file_iso'] = $this->user_model->get_file_iso()->result();

		// echo json_encode($dat);
		$this->load->view('header');
		$this->load->view('iso-document-view', $data);
		// $this->load->view('footer');
	}

	// ALDY: LOGIN USER
	public function user($param){
		$data['type']=$param;
		$message = $this->session->flashdata('validasi-login');
		$data['message']=$message;
		$this->load->view('login', $data);
	}

	public function log($Type, $detil, $username){
		/*Insert Log*/
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
	 public function login() {

	 	
     $username = $this->input->post('username');
     // $password = hash ( "sha256", $this->input->post('password'));

     $password =  $this->input->post('password');
     $cek = $this->user_model->cek_login($username, $password);
     if($cek->num_rows() > 0){
     if ($cek->row()->status_user == 0) { $this->session->set_flashdata('validasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');
  $this->user('login');}
      else {$this->session->set_flashdata('validasi-login', 'Selamat Datang');
      $this->log("login","Login", $username);
      $id_user = $this->session->userdata('id_user');

      $cek_menu= $this->user_model->get_aplication($id_user);

      $this->session->set_userdata(array(
	    'id_user'  		=> $cek->row()->id_user,
	    'username' 		=> $cek->row()->username,
	    'email' 		=> $cek->row()->email,
	    'status_user'   => $cek->row()->status_user,
	    'status' => "login",
		));

     $this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
      }else{
      	$this->session->set_flashdata('validasi-login', 'Username/Password yang anda masukkan salah');
      $this->user('login');
  }
      }

      public function logout() {	
      	$username = $this->session->userdata('username');
      	$this->log("logout","logout", $username);
		$this->session->sess_destroy();	
		redirect(base_url("SipinHome"));
		}

	/* register function. */
	/* register function. */
	public function register() {
		$regex = $this->regex($this->input->post('password'));
		if ($regex == "true"){
		$name = $this->input->post('fullname');
		$username = $this->input->post('username');
		$no_iin    = $this->input->post('iin-number');
		$email    = $this->input->post('email');
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('retype-password');
		
		if (($this->input->post('secutity_code') == $this->session->userdata('mycaptcha'))){
		if ($password == $password_confirm){
			$cek = $this->user_model->cek_status_user($username, $password);
	        if($cek->num_rows() > 0){
        		$this->session->set_flashdata('validasi-login', 'Username/Email sudah terdaftar');
  				$this->user('register');
	    	}else {
	    		if ($this->user_model->register_user($email ,$username, $password, $name)){
					if ($this->user_model->sendMail($email,$username, "Please click on the below activation link to verify your email address.")) {
			
				       $this->session->set_flashdata('validasi-login', 'Anda berhasil melakukan registrasi, silahkan periksa pesan masuk email Anda untuk mengaktifkan akun yang baru Anda buat');
				       $this->log("login","Login", $username);
				         $this->user('register');
				      }else {echo  "Gagal";
				       $this->session->set_flashdata('validasi-login', 'Gagal melakukan registrasi');
				         $this->user('register'); }}}
		}else { 
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
				         $this->user('register');

				 }
	}

	/*Forgot Password*/
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
	$this->user('forgot'); } 
	}

	/*Verifikasi Email*/
	public function verify($hash=NULL) {
    if ($this->user_model->verifyEmail($hash)) {
      $this->session->set_flashdata(md5('sukses'), "Email sukses diverifikasi!");
      echo  "Email sukses diverifikasi!";} 
      else {$this->session->set_flashdata(md5('notification'), "Email gagal terverifikasi");
      echo  "Email gagal diverifikasi!"; // redirect('/url/register');
  		}
  	}
  	/*Regex falidasi karakter password*/
	public function regex($password){
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialcaracter    = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password);
	if(!$uppercase || !$lowercase || !$number || !$specialcaracter || strlen($password) <= 8) {
	 return false;
	} else {
		return true;
	}
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

	public function submitiin () {
		$this->captcha();
		$id_user = $this->session->userdata('id_user');
		$Status =  $this->user_model->get_applications_Status($id_user);
		// echo $Status->row()->id_application_status_name ;
		// $this->session->set_flashdata('satu', "PENDING");
		$this->session->set_flashdata('satu', "PENDING");
		if ($Status->num_rows() > 0){
		
		switch ($Status->row()->id_application_status_name) {
            case '1':
            if ($Status->row()->process_status == "COMPLETED"){
            $this->session->set_flashdata('satu', "COMPLETED");
             $this->session->set_flashdata('dua', "PENDING");
            } else if ($Status->row()->process_status == "PENDING"){
			$this->session->set_flashdata('satu', "PENDING");
            } 
            
               break;
            case '2':
            if ($Status->row()->process_status == "COMPLETED"){
            $this->session->set_flashdata('dua', "COMPLETED");
              $this->session->set_flashdata('tiga', "PENDING");
            } else if ($Status->row()->process_status == "PENDING"){
			$this->session->set_flashdata('dua', "PENDING");
            } else{
            $this->session->set_flashdata('dua', "");
            }
                break;
            case '3':
             if ($Status->row()->process_status == "COMPLETED"){
            $this->session->set_flashdata('tiga', "COMPLETED");
            } else if ($Status->row()->process_status == "PENDING"){
			$this->session->set_flashdata('tiga', "PENDING");
            } else{
            $this->session->set_flashdata('tiga', "");
            }

            case '4':
            $this->session->set_flashdata('empat', $Status->row()->process_status);
            	break;
            case '5':
            $this->session->set_flashdata('lima', $Status->row()->process_status);
            	 break;
            case '6':
                 $this->session->set_flashdata('enam', $Status->row()->process_status);
                break;
            case '7':
                 $this->session->set_flashdata('tujuh', $Status->row()->process_status);
                break;
            case '8':
                 $this->session->set_flashdata('delapan', $Status->row()->process_status);
                break;
            case '9':
                 $this->session->set_flashdata('sembilan', $Status->row()->process_status);
                break;
            case '10':
            $this->session->set_flashdata('sepuluh', $Status->row()->process_status);
               break;
            case '11':
            $this->session->set_flashdata('sebelas', $Status->row()->process_status);
                break;
            case '12':
            $this->session->set_flashdata('duabelas', $Status->row()->process_status);
                break;
            case '13':
            $this->session->set_flashdata('tigabelas', $Status->row()->process_status);
            	break;
            case '14':
            $this->session->set_flashdata('empatbelas', $Status->row()->process_status);
            	 break;
            case '15':
                 $this->session->set_flashdata('limabelas', $Status->row()->process_status);
                break;
            case '16':
                 $this->session->set_flashdata('enambelas', $Status->row()->process_status);
                break;
            case '17':
                 $this->session->set_flashdata('tujuhbelas', $Status->row()->process_status);
                break;
            case '18':
                 $this->session->set_flashdata('delapanbelas', $Status->row()->process_status);
                break;
            case '19':
                 $this->session->set_flashdata('sembilanbelas', $Status->row()->process_status);
                break;

            
        }
        }

		$this->load->view('header');
		$this->load->view('submit-iin');
		$this->load->view('footer');
		
			
	}

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

	public function contact_us_prossess()
	{	
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$message = $this->input->post('message');
		echo $email;
		echo $name;
		echo $message;

		$this->admin_model->sendMail($email,$name, $message);
		// redirect(base_url('contact-us'));

	}
 }
