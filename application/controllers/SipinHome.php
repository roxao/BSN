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
	}
 
	public function index(){		
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}


	// ALDY: FILE ISO 
	public function file_iso_7812(){		
		$data['file_iso'] = 'http://localhost/BSN/assets/sample.pdf';
		$this->load->view('header');
		$this->load->view('iso7812', $data);
		$this->load->view('footer');
	}

	// ALDY: LOGIN USER
	public function user($param){
		// ISI $param, UNTUK LAYOUT YANG INGIN DI BUKA, CONTOH: login, register, forgot 
		// contoh url: localhost/BSN/user/login
		// * lowercase
		$data['type']=$param;
		// ISI MESSAGE JIKA BALIKAN ADA ERROR
		// CONTOH 
		// - USER LOGIN DENGAN PASSWORD YANG SALAH, 
		// - USER DAFTAR DENGAN USERNAME YANG SUDAH TERDAFTAR
		// - FORGOT PASSWORD: E-MAIL TIDAK TERDAFTAR
		// JIKA TIDAK ADA ERROR ISI DENGAN ''
		$message = $this->session->flashdata('validasi-login');
		$data['message']=$message;
		$this->load->view('login', $data);
	}
	/* User login function. */
	 public function login() {
     $username = $this->input->post('username');
     // $password = hash ( "sha256", $this->input->post('password'));

     $password =  $this->input->post('password');
     $cek = $this->user_model->cek_login($username, $password);
     if($cek->num_rows() > 0){
     if ($cek->row()->status_user == 0){ $this->session->set_flashdata('validasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');
  $this->user('login');}
      else {$this->session->set_flashdata('validasi-login', 'Selamat Datang');
      $id_user = $this->session->userdata('id_user');

      $cek_menu= $this->user_model->get_aplication($id_user);
      $this->index();

      $this->session->set_userdata(array(
	    'id_user'  => $cek->row()->id_user,
	    'username' => $cek->row()->username,
	    'email'  => $cek->row()->email,
	    'status_user'     => $cek->row()->status_user,
		));
	}
      }else{
      	$this->session->set_flashdata('validasi-login', 'Username/Password yang anda masukkan salah');
      $this->user('login');
  }
      }

      public function logout() {	
		$this->session->sess_destroy();
		$data['logout'] = 'You have been logged out.';		
		$this->index();
		}

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
		// $password = hash ( "sha256", $this->input->post('password'));
		
		if ($password == $password_confirm){
			$cek = $this->user_model->cek_status_user($username, $password);
	        if($cek->num_rows() > 0){
	        		$this->session->set_flashdata('validasi-login', 'Username/Email sudah terdaftar');
      $this->user('register');
	    	}else {
	    		if ($this->user_model->register_user($email ,$username, $password, $name)){
						if ($this->user_model->sendMail($email,$username)) {
				     
				       $this->session->set_flashdata('validasi-login', 'Anda berhasil melakukan registrasi, silahkan periksa pesan masuk email Anda untuk mengaktifkan akun yang baru Anda buat');
				         $this->user('register');
				      }else {echo  "Gagal";
				       $this->session->set_flashdata('validasi-login', 'Gagal melakukan registrasi');
				         $this->user('register'); }}}
		}else { 
	$this->session->set_flashdata('validasi-login', 'password yang anda masukkan tidak sesuai');
				         $this->user('register');}	
		} else {

	$this->session->set_flashdata('validasi-login', 'Password minimal 8 karakter dan harus huruf besar, huruf kecil, angka, dan special character (Contoh : aAz123@#');
				         $this->user('register');
				     }	
	}

	/*Forgot Password*/
	public function forgot_password() {
	$username_forgot = $this->input->post('E-mail');
	$cek = $this->user_model->forgot_password($username_forgot);
	if ($cek->num_rows() > 0){
	if ($this->user_model->sendMail($cek->row()->email, $cek->row()->name)) {
  	$this->session->set_flashdata('validasi-login', 'Anda berhasil melakukan reset password');
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
 }
