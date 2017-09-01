<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SipinAdmin extends CI_Controller {



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

	/* User login function. */
	 public function login() {
     $username = $this->input->post('username');
     // $password = hash ( "sha256", $this->input->post('password'));
     $password =  $this->input->post('password');
     $cek = $this->user_model->cek_login($username, $password);
     if($cek->num_rows() > 0){
     if ($cek->row()->status_user == 0){ $this->session->set_flashdata('falidasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');}
      else {$this->session->set_flashdata('falidasi-login', 'Selamat Datang');
      
      $this->session->set_userdata(array(
    'id_user'  => $cek->row()->id_user,
    'username' => $cek->row()->username,
    'email'  => $cek->row()->email,
    'status_user'     => $cek->row()->status_user,
    
));
	  $this->load->view('header');
	  $this->load->view('submit-iin');
	  $this->load->view('footer');
	  $this->index();

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
		echo "Berhasil tersimpan";
	} else {
		echo "Dibatalkan";
	}	

	}
/*melakukan donload document file step ke1*/ 
	public function download_file(){				
		force_download('gambar/malasngoding.png',NULL);
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
