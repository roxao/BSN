<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Verifikasi_Controller extends CI_Controller 
{


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

	public function VERIF_NEW_REQ($id_application_status)
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_pengajuan_permohonan', $data);
	}

	public function VERIF_NEW_REQ_PROSES()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'REQ_VERIF_RES',
        		'approval_status' => '1',
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
        	$this->admin_model->next_step($data,$condition);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

	public function VERIF_UPLDOC_REQ($id_application_status)
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
//data dari user
        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_cek_upload_document', $data);
	}

	public function VERIF_UPLDOC_REQ_PROSES_SUCCEST()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'UPL_BILL_REQ',
        		'approval_status' => '1',
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
        	$this->admin_model->next_step($data,$condition);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

//upload kurang 
	public function VERIF_UPLDOC_REQ_PROSES_REVISI()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'REV_DOC_REQ',
        		'approval_status' => '1',
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
        	$this->admin_model->next_step($data,$condition);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

	public function VERIF_REVDOC_REQ($id_application_status)
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
//data dari user
        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('inbox_setujui', $data);
	}

	public function VERIF_REVDOC_REQ_SUCCEST()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'UPL_BILL_REQ',
        		'approval_status' => '1',
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
        	$this->admin_model->next_step($data,$condition);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

	public function UPL_BILL_REQ($id_application_status)
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }
//data dari user
        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_upload_biling_code_simponi', $data);
	}

	public function UPL_BILL_REQ_SUCCEST()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'PAY_UPL_REQ',
        		'approval_status' => '1',
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
        	$this->admin_model->next_step($data,$condition);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

	public function VERIF_PAY_REQ($id_application_status)
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_konfirmasi_assessment_lapangan', $data);
	}

	public function VERIF_PAY_REQ_SUCCEST()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'CONF_ASSESS_REQ',
        		'approval_status' => '1',
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
        	$this->admin_model->next_step($data,$condition);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

	public function FIELD_ASSESS_REQ($id_application_status)
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_hasil_assessment_lapangan', $data);
	}

	public function FIELD_ASSESS_REQ_SUCCEST()
	{
		$logged_in = $this->session->userdata('admin_status');
        if (!$logged_in)
        {
            redirect(site_url('proses_login_admin'));
        }

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'UPL_RES_ASSESS_REQ',
        		'approval_status' => '1',
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
        	$this->admin_model->next_step($data,$condition);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}
}