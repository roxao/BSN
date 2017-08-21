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
		$this->load->library('email');
		$this->load->helper('form');   
		$this->model = $this->user_model;
        $this->load->database();
		
	}
 
	public function index(){		
		$this->load->view('header');
		$this->load->view('content');
		$this->load->view('footer');
	}

	  public function login() {
        $username = $this->input->post('username');
        // $password = hash ( "sha256", $this->input->post('password'));
        $password =  $this->input->post('password');
        
        $cek = $this->user_model->cek_login($username, $password);
        if($cek->num_rows() > 0){
		$this->session->set_flashdata('welcome', 'Selamat Datang');
		$this->load->view('header');
		$this->load->view('content');
		$this->load->view('footer');
        }else{
            echo "Username dan password salah !";
        }

    }


	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		// create the data object
		$data = new stdClass();
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		$email    = $this->input->post('email');
		$username = $this->input->post('username');
		// $password = hash ( "sha256", $this->input->post('password'));
		$password = $this->input->post('password');
		$name = $this->input->post('nama');
		$cek = $this->user_model->cek_login($username, $password);



        if($cek->num_rows() > 0){
        	echo "Username dan password sudah terdaftar !";
        }else{
        	if ($this->user_model->register_user($email ,$username , $password, $name)) {
				 echo "berhasil !";
      			} 
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