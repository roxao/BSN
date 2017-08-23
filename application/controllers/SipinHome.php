<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SipinHome extends CI_Controller {

	// function __construct(){
	// 	parent::__construct();
	// 	$this->load->helper('url');


	// }

	public function __construct() {
		
		parent::__construct();

		// load library dan helper
	   	$this->load->library('session');
	   	$this->load->helper(array('captcha','url','form'));
		$this->load->model('user_model');
		$this->load->library('email','form_validation', 'curl');
		$this->load->helper('form');   
		$this->model = $this->user_model;
        $this->load->database();
		
	}
 
	public function index(){		
		$this->load->view('header');
		$this->load->view('content');
		$this->load->view('footer');
	}

	/* login function. */
	  public function login() {
        $username = $this->input->post('username');
        // $password = hash ( "sha256", $this->input->post('password'));
        $password =  $this->input->post('password');
        $cek = $this->user_model->cek_login($username, $password);
        if($cek->num_rows() > 0){
        	if ($cek->row()->user_status == 0){ $this->session->set_flashdata('falidasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');}
        	else {$this->session->set_flashdata('falidasi-login', 'Selamat Datang');
				  $this->load->view('header');
				  $this->load->view('content');
				  $this->load->view('footer');}
        	}else{echo "Username dan password salah !";}
        	}

      public function logout() {	
		$this->session->sess_destroy();
		$data['logout'] = 'You have been logged out.';		
		$this->index();
		}

	/* register function. */
	public function register() {
		
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
				      }else {echo  "Gagal"; } 
	    			
	    	}
	    	}
		}else {echo "password yang anda masukkan tidak sesuai"; }	
	}

public function forgot_password() {
	$username_forgot = $this->input->post('username_forgot');

	$cek = $this->user_model->forgot_password($username_forgot);

	if ($cek->num_rows() > 0){
		if ($this->user_model->sendMail($cek->row()->email, $cek->row()->name)) {
				       echo  "Anda berhasil melakukan reset password";
				      }else {echo  "Gagal"; } 
				  } else {echo  "User tidak ditemukan"; 
			} 
	}
	public function verify($hash=NULL) {
    if ($this->user_model->verifyEmail($hash)) {
      $this->session->set_flashdata(md5('sukses'), "Email sukses diverifikasi!");
      echo  "Email sukses diverifikasi!";
     
    } else {
      $this->session->set_flashdata(md5('notification'), "Email gagal terverifikasi");
      echo  "Email gagal diverifikasi!";
      // redirect('/url/register');
    }
  }
	

	public function regex(){
		// $password = hash ( "sha256", $this->input->post('password'));
        $password =  $this->input->post('password');

		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$spesial_karakter	= preg_match('@[!@#$%^&*()_-+|;:<>,.?]+$/]@', $password);

if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
  // tell the user something went wrong
}
	}


	function captcha()
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