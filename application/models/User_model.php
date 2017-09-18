<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
            'status_user'   => "0",
            'survey_status'   => "0",
);
        return $this->db->insert('user', $data);        
    }

    public function cek_login($username,$password){  
    $this->db->where("email = '$username' or username = '$username'");  
    $this->db->where('password', $password); 
        return  $this->db->get('user');   
    }

    /*Forgot Password*/
    public function forgot_password($username){ 
    $this->db->select('*');
    $this->db->from('user'); 
    $this->db->join('applications', 'user.id_user=applications.id_user');
    $this->db->where("user.email = '$username' or user.username = '$username' or instance_name = '$username'");        
    $query = $this->db->get(); 
 
        return  $query;   
    }

    /*Melkukan pengecekan file untuk didownload di step2*/
    public function getdocument_aplication($id_user){ 
    $this->db->select('*');
    $this->db->from('applications'); 
    $this->db->join('application_file', 'applications.id_application=application_file.id_application');
    $this->db->join('document_config', 'application_file.id_document_config=document_config.id_document_config');
    $this->db->where('applications.id_user',$id_user);
    // $this->db->where('document_config.type','STATIC'); 
    // $this->db->where('document_config.key',"IPPSA"); 


    $query = $this->db->get(); 
    $results = $query->result();
 
        return  $results ;   
    }

    /*Cek Status User*/
    public function cek_status_user($username,$password){  
    $this->db->where("email = '$username' or username = '$username'"); 
        return  $this->db->get('user');   
    }

    public function insert_pengajuan ($data){
        $this->db->insert('applications', $data);
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

    public function update_aplication_status($data)
    {
        $this->db->where();
        $this->db->update('document_config',$data);
    }
    
    /*Verifikasi Email dan Update status user*/
    public function verifyEmail($key) {
        // nilai dari status yang berawal dari Tidak Aktif akan diubah menjadi Aktif disini
        $data = array('user_status' => "1");
        $this->db->where('md5(email)', $key);

        return $this->db->update('user', $data);
      }

    /*Simpan File*/
    public function simpan($data){
        $this->db->insert('upload', $data);
     }
    
}