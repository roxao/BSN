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
        $this->load->view('admin/admin_inbox', $data);
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

	public function application_crud($params,$id) {	
        switch ($params) {
			case 'get_application':
		        $data = $this->admin_model->get_application($id)->result();
		        echo json_encode($data);
				break;
			case 'get_assessment':
				$data = $this->admin_model->get_assessment()->result();
		        echo json_encode($data);
				break;
			case null:
				$this->load->view('admin/login');
				break;
		}
	}

	private function session_login(){
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) redirect(base_url('dashboard/user/login'));
        return null;
	}


	public function view_step($subparams = null) {
		switch ($subparams) {
			case 'step1':
		        $this->load->view('admin/step/step1');
				break;
			case 'step2':
				$this->load->view('admin/step/step2');
				break;
			case null:
				$this->load->view('admin/login');
				break;
		}
	}

}
