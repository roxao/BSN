<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $params = null;
    var $subparams = null;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('admin_model');
		$this->load->library('email');
		$this->load->helper('form'); 
		$this->load->database();
		$this->model = $this->admin_model;
	}

	public function index(){
		// $this->session_login();
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications()->result();
        $this->load->view('admin/inbox', $data);
    }

	public function user($subparams = null) {
		switch ($subparams) {
			case 'login':
		        $this->load->view('admin/login');
				break;
			case 'register':
				$this->load->view('admin/register');
				break;
			case null:
				$this->load->view('admin/login');
				break;
		}
	}

	public function get_app_data() {	
		// $this->session_login();
		$id = $this->input->post('getid');
		$data['title_box'] = $this->input->post('status'); 
		if($id!=null){
			switch ($this->input->post('getstep')) {
			case 'verif_new_req':
		        $data['application'] = $this->admin_model->get_application($id)->result()[0];
		        echo json_encode($data);
				break;
			case 'verif_upldoc_req':
				$data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
		        echo json_encode($data);
				break;
			case 3:
				$data['assessment_list'] = $this->admin_model->get_assessment()->result();
				$data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
		        echo json_encode($data);
				break; 	
			case null:
				$this->load->view('admin/login');
				break;
			}
		}
	}

	private function session_login(){
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) redirect(base_url('dashboard/user/login'));
        return false;
	}


	public function approval($subparams = null) {
		// $this->session_login();
		$this->load->view('admin/approval/'.$subparams);
	}

}
