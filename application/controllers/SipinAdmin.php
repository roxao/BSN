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
	
	
// 	ini yang baru dibawah ini:
	
	public function __construct() 
	{
		
		parent::__construct();
		$this->load->library('session');
	    $this->load->helper(array('captcha','url','form'));
		$this->load->model('admin_model');
		$this->load->library('email');
		$this->load->helper('form'); 
		$this->load->database();
		$this->model = $this->admin_model;
	}

	public function homedds()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
        $this->load->view('header_admin');
		$this->load->view('content_admin');
	}

	public function login_admin() 
	{
		// $this->load->view('header_admin');
		// $this->load->view('content_admin');
		$this->load->view('login_admin');

	}

	public function proses_login() 
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->admin_model->cek_login($username,$password);
		
		echo $cek->num_rows();
		if($cek->num_rows() > 0)
		{
			 if ($cek->row()->admin_status == 0)
			 { 
			 	$this->session->set_flashdata('falidasi-login', 'Anda belum melakukan Aktifasi silahkan lakukan aktifasi');
			 	echo "gagal dari status";
			 }
			 else
			 {
			 	if($cek->row()->admin_role == 0)
			 	{
			 		
			 		$this->session->set_flashdata('falidasi-login', 'Selamat Datang Supper Admin');
			 		// masuk ke tampilan super admin
			 		 $this->session->set_userdata(array(
				    'id_admin'  	=> $cek->row()->id_admin,
				    'username' 		=> $cek->row()->username,
				    'email'  		=> $cek->row()->email,
				    'admin_status' 	=> $cek->row()->admin_status));
			 		// ke index super admin 
			    //$this->index();
			 		 $this->load->view('header_admin');
					$this->load->view('content_admin');
			 	}
			 	else
			 	{
			 		echo "Selamat Datang Admin";
			 		$this->session->set_flashdata('falidasi-login', 'Selamat Datang admin');
     				 // masuk ke tampilan admin
				    $this->session->set_userdata(array(
				    'id_admin'  	=> $cek->row()->id_admin,
				    'username' 		=> $cek->row()->username,
				    'email'  		=> $cek->row()->email,
				    'admin_status' 	=> $cek->row()->admin_status));
				      // ke index admin 
			    	//$this->index();
			    	$this->load->view('header_admin');
					$this->load->view('content_admin');
			 	}
			 	
			 }
		}
		else
		{

			//redirect(site_url('login'));
		}
	}


	 public function logout_admin() 
	 {	
		$this->session->sess_destroy();
		$data['logout'] = 'You have been logged out.';		
		$this->login_admin();
	}

	 public function tambah_admin()
	 {
	 	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
	 	$this->load->view('super_admin_insert_admin');
	 }
	 public function tambah_admin_proses(){
        $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

        if($this->input->post('insert') == "insert")
        {
        	$data = array(
        		'email' => $this->input->post('email'),
        		'username' => $this->input->post('username'),
        		'password' => $this->input->post('password'),
        		'admin_status' => $this->input->post('admin_status'),
        		'admin_role' => $this->input->post('admin_role'),
        		'created_date' => date('Y-m-j H:i:s'),
        		'created_by' => $this->session->userdata('username'),
        		'last_update_date' => date('Y-m-j H:i:s'),
        		'modified_by' => $this->input->post('username')
        		);
        	$this->admin_model->insert_admin($data);
        	echo "Data admin Berhasil tersimpan";

        }else
        {
        	echo "gagal disimpan";
        }    
    }

    public function tambah_tim_asesment()
     {
     	 $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
     	$this->load->view('super_admin_insert_asesment');
     }

    public function tambah_tim_asesment_proses()
     {
     	 $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

         if($this->input->post('insert') == "insert")
        {
        	$name = array('name' => $this->input->post('name'));
			$title = array('title' => $this->input->post('title'));

        	$this->admin_model->insert_asesment($name,$title);
        	echo "Data Tim Asesment Berhasil tersimpan";

        }else
        {
        	echo "gagal disimpan";
        }

     }

     public function read_tim_asesment()
     {
     	 $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

         $data['data_asesment']    = $this->admin_model->read_asesment()->result();
         $this->load->view('data_asesment', $data);

     }

     public function read_user()
     {
     	 $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

        $data['data_user'] = $this->admin_model->read_user()->result();
        $this->load->view('data_user',$data);
     }

      public function read_applications()
     {
     	 $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

        $data['applications'] = $this->admin_model->read_applications()->result();
        $this->load->view('inbox',$data);
     }

     public function edit_aplication($id_application)
     {
     	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
        $data['aplication'] = $this->admin_model->get_aplication($id_application)->result();
        $this->load->view('inbox_edit', $data);
     }

      public function edit_aplication_proses()
     {
     	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
       if($this->input->post('update') == "update")
        {
        	$data = array(
        		'applicant' => $this->input->post('applicant'),
        		'instance_name' => $this->input->post('instance_name'),
      
        		
        		'id_admin' => $this->session->userdata('id_admin'),
        		'last_updated_date' => date('Y-m-j H:i:s')

        		);
        	$condition = array('id_application' => $this->input->post('id_application'));
        	$this->admin_model->update_aplications($data,$condition);
        	echo "Data admin Berhasil tersimpan";
        	// $this->read_applications();
        	 header("refresh:0; inbox");

        }else
        {
        	echo "gagal disimpan";
        }
     }

     public function setujui_pengajuan($id_application_status)
     {
     	$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

        $cekData = $this->admin_model->get_aplication($id_application_status)->result();
        if($cekData->num_rows() > 0)
		{			 
			 	if($cekData->row()->process_status == 0)
			 	{
			 		$data = array(
        		'process_status' => 1
        		);
			 	}
			 	elseif ($cekData->row()->process_status == 1) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 2) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 3) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 4) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 5) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 6) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 7) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 8) 
			 	{
			 		# code...
			 	}
			 	elseif ($cekData->row()->process_status == 9) 
			 	{
			 		# code...
			 	}
			 
		}else
		{
			echo "data tidak ditemukan";
		}

     }
	
	
 }
