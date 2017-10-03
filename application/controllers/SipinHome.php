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
	public function view_login(){		
		$this->load->view('header');
		$this->load->view('login');
		// $this->load->view('footer');
	}
	/* User login function. */
	 public function login() {
     $username = $this->input->post('username');
     // $password = hash ( "sha256", $this->input->post('password'));
     $password =  $this->input->post('password');
     $cek = $this->user_model->cek_login($username, $password);
     if($cek->num_rows() > 0){
     if ($cek->row()->status_user == 0){ $this->session->set_flashdata('validasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');}
      else {$this->session->set_flashdata('validasi-login', 'Selamat Datang');
      $id_user = $this->session->userdata('id_user');

      $cek_menu= $this->user_model->get_aplication($id_user);
      $this->session->set_flashdata('validasi-menu', $cek_menu->row()->application_type);
     $this->index();

      $this->session->set_userdata(array(
    'id_user'  => $cek->row()->id_user,
    'username' => $cek->row()->username,
    'email'  => $cek->row()->email,
    'status_user'     => $cek->row()->status_user,
    
	));
	  
	 

	}
      }else{echo "Username dan password salah !";}
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
		$email    = $this->input->post('email');
		$username = $this->input->post('username');
		// $password = hash ( "sha256", $this->input->post('password'));
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		$name = $this->input->post('nama');
		if ($password == $password_confirm){
			$cek = $this->user_model->cek_status_user($username, $password);
	        if($cek->num_rows() > 0){
	        	echo "Username/Email sudah terdaftar";
	    	}else {
	    		if ($this->user_model->register_user($email ,$username, $password, $name)){
						if ($this->user_model->sendMail($email,$username)) {
				       echo  "Anda berhasil melakukan registrasi, silahkan periksa pesan masuk email Anda untuk mengaktifkan akun yang baru Anda buat";
				      }else {echo  "Gagal"; }}}
		}else {echo "password yang anda masukkan tidak sesuai"; }	
		} else { echo "Password minimal 8 karakter dan harus huruf besar, huruf kecil, angka, dan special character (Contoh : aAz123@#)";}	
	}

	/*Forgot Password*/
	public function forgot_password() {
	$username_forgot = $this->input->post('username_forgot');
	$cek = $this->user_model->forgot_password($username_forgot);
	if ($cek->num_rows() > 0){
	if ($this->user_model->sendMail($cek->row()->email, $cek->row()->name)) {
	echo  "Anda berhasil melakukan reset password";}else {echo  "Gagal"; } 
	} else {echo  "User tidak ditemukan"; } 
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
