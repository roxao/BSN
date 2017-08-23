<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {
	
	/*construct function*/
	public function __construct() {
		parent::__construct();
		$this->load->database();	
	}
	
	/*Registrasi*/
	public function register_user($email, $username, $password, $name) {
		$data = array(
			'email'      => $email,
			'username'   => $username,
			'password'   => $password,
			'name'   => $name,
			'created_date' => date('Y-m-j H:i:s'),
			'created_by'   => $name,
			'modified_date'   => date('Y-m-j H:i:s'),
			'modified_by'   => $name,
			'user_status'   => "0",
			'survey_status'   => "0",
);
		return $this->db->insert('db_user', $data);		
	}

	public function cek_login($username,$password){  
    $this->db->where("email = '$username' or username = '$username'");  
    $this->db->where('password', $password); 
        return  $this->db->get('db_user');   
    }

    /*Forgot Password*/
    public function forgot_password($username){ 
	$this->db->select('*');
    $this->db->from('db_user'); 
    $this->db->join('db_application', 'db_user.id_user=db_application.id_user');
    $this->db->where("db_user.email = '$username' or db_user.username = '$username' or instance_name = '$username'");        
    $query = $this->db->get(); 
 
        return  $query;   
    }

    /*Cek Status User*/
	public function cek_status_user($username,$password){  
    $this->db->where("email = '$username' or username = '$username'"); 
        return  $this->db->get('db_user');   
    }

    /*Proses send email*/
 	public function sendMail($email,$username) {
    $from_email = 'andaru140789@gmail.com'; // ganti dengan email kalian
    $subject = 'Verify Your Email Address';
    $message = 'Dear '. $username .',<br /><br />
                Please click on the below activation link to verify your email address.<br /><br />
                http://localhost/BSN/SipinHome/verify/' . md5($email) . '<br /><br /><br />
                Thanks<br />
                BSN';

    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com'; // sesuaikan dengan host email
    $config['smtp_timeout'] = '7';
    $config['smtp_port'] = '465'; // sesuaikan
    $config['smtp_user'] = $from_email;
    $config['smtp_pass'] = '14071989'; // ganti dengan password email
    $config['mailtype'] = 'html';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    $config['newline'] = "\r\n";
    $config['crlf'] = "\r\n";
    $this->email->initialize($config);
    $this->email->from($from_email, 'Bsn');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    // gunakan return untuk mengembalikan nilai yang akan selanjutnya diproses ke verifikasi email
    return $this->email->send();
  	}
	
	/*Verifikasi Email dan Update status user*/
	public function verifyEmail($key) {
	    // nilai dari status yang berawal dari Tidak Aktif akan diubah menjadi Aktif disini
	    $data = array('user_status' => "1");
	    $this->db->where('md5(email)', $key);

	    return $this->db->update('db_user', $data);
	  }

	/*Simpan File*/
	public function simpan($data){
        $this->db->insert('upload', $data);
     }
	
}