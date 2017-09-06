<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct() {
		
	parent::__construct();
	$this->load->database();
		
	}

	public function cek_login($username,$password) 
	{  

       	$this->db->where('username', $username);
     	$this->db->where('password', $password);

        return  $this->db->get('admin');   
    }

     public function insert_admin ($data){
        $this->db->insert('admin', $data);
    }

    public function insert_asesment ($name,$title){
        $this->db->insert('assessment_team', $name);
        $this->db->insert('assessment_team_title', $title);
    }


    // ALL GET TABLE
    public function get_assessment(){
    	return $this->db->get('assessment_team');
    }

    public function get_user(){
    	return $this->db->get('user');
    }

    public function get_applications(){
    	// return $this->db->get('applications');
        $this->db->select('*');
        $this->db->from('application_status')
             ->join ('applications', 'application_status.id_application = applications.id_application')
			 ->join ('application_status_form_mapping', 'application_status_form_mapping.id_application_status = application_status_form_mapping.id_application_status')
			 ->join ('application_status_name', 'application_status_name.id_application_status_name=application_status.id_application_status_name');
        return $this->db->get();
        // return $query->result();
    }

    public function get_application($id_application){
	    $this->db->where('id_application', $id_application); 
        $this->db->select("*");
        $this->db->from("applications");
        return $this->db->get();
    }
}
?>
