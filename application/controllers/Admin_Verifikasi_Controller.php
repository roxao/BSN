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

        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('admin_pengajuan_permohonan', $data);
	}

	public function VERIF_NEW_REQ_PROSES()
	{

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => 'COMPLETED',
            	'created_date' => date('Y-m-j'),
      			// 'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' adding new applicant',
                'log_type' => 'added new applicant '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

        	$this->admin_model->next_step($data,$condition);

                $data2 = array(
                'id_application '=> $this->input->post('id_application'),
                'id_application_status_name' => '2',
                'process_status ' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'),
                // 'modified_by ' => $this->session->userdata('username')
                );
            
            $this->admin_model->insert_app_status($data2);

        	 // header("refresh:0; sipinAdmin/read_applications");
        	
        }else if ($this->input->post('HAVE-IIN') == "HAVE-IIN") 
        {
                $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Rejected new applicant',
                'log_type' => 'added new applicant '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

                $data2 = array(
                'id_application '=> $this->input->post('id_application'),
                'id_application_status_name' => '2',
                'process_status ' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'),
                // 'modified_by ' => $this->session->userdata('username')
                );
            $this->admin_model->insert_app_status($data2);

                $data3 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'REJECTED'
                    );
           $this->admin_model->insert_app_sts_for_map($data3);

                $data4 = array(
                    'type' => 'COMMENT',
                    'value' => $this->input->post('coment')
                    );
            $this->admin_model->insert_app_sts_for_map($data4);
                    
                    $data5 = array(
                        'iin_status'=> '1');

                    $id_application = array('id_application'=> $this->input->post('id_application'));
            $this->admin_model->update_app($data5,$id_application);


        } else
        {
        	echo "bukan tombol setujui";
        }
	}




	public function VERIF_UPLDOC_REQ($id_application_status)
	{
	    $data['aplication_setujui'] = $this->admin_model->get_application_file($id_application_status)->result();
        
        $this->load->view('admin_cek_upload_document', $data);
	}

	public function VERIF_UPLDOC_REQ_PROSES_SUCCEST()
	{

       if($this->input->post('setujui') == "setujui")
        {	
        	$data = array(
                'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '3',
              
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' approved new upload transaksi',
                'log_type' => 'added new applicant '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

        	$this->admin_model->next_step($data,$condition);

            $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '4',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data4,$condition);

        	$data5 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '5',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data5,$condition);

            $data6 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '6',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data6,$condition);

                  $data2 = array(
                    'type' => 'REVISED_DOC',
                    'value' => 'x',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data2);

        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

    public function VERIF_UPLDOC_REQ_PROSES_REVITIONS()
    {
        if($this->input->post('revisi') == "revisi")
        {
            $data = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '3',
              
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Verifikasi Kelengkapan Dokumen',
                'log_type' => 'added new applicant '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

             $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '4',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data4,$condition);

             $data2 = array(
                    'type' => 'REVISED_DOC',
                    'value' => 'document nomer berapa atau nama document',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data2);
        }
    }

   





	public function UPL_BILL_REQ($id_application_status)
	{
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('admin_upload_biling_code_simponi', $data);
	}

	public function UPL_BILL_REQ_SUCCEST()
	{

       if($this->input->post('setujui') == "setujui")
        {	


        		$data = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '6',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Upload Billing Code SIMPONI',
                'log_type' => 'added new applicant '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);
        	$this->admin_model->next_step($data,$condition);

             $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '7',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data2,$condition);

            $data3 = array(
                'id_application' => $this->input->post('id_application'),
                'id_document_config'=> '4',
                'path_id'=> '////'
                );

            $this->admin_model->insert_application_file($data3);

            $data4 = array(
                    'type' => 'BILLING_EXPIRED',
                    'value' => 'contoh (29-08-2017)',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data4);
  	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

    public function REUPL_BILL_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('admin_upload_biling_code_simponi', $data);
    }

    public function REUPL_BILL_REQ_PROSESS()
    {
        if ($this->input->post('setujui') == "setujui") {
            
            $data = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '6',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

             $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Reupload Billing Code SIMPONI',
                'log_type' => 'added new applicant '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '7',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $this->admin_model->insert_app_status($data2,$condition);

            $data3 = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '8',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $this->admin_model->insert_app_status($data3,$condition);

             $data4 = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '9',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $this->admin_model->insert_app_status($data4,$condition);

             $data5 = array(
                'process_status' => 'PENDING',
                'id_application_status_name' => '10',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $this->admin_model->insert_app_status($data5,$condition);

               $data3 = array(
                'id_application' => $this->input->post('id_application'),
                'id_document_config'=> '4',
                'path_id'=> '//// ini buat ganti code billingnya'
                );

            $this->admin_model->insert_application_file($data3);

            $data6 = array(
                    'type' => 'BILLING_EXPIRED',
                    'value' => 'contoh (29-08-2017)',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data6);


        }
    }

    public function VERIF_REV_PAY_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('admin_konfirmasi_assessment_lapangan', $data);
    }

    public function VERIF_REV_PAY_REQ_SUCCEST()
    {
         $data = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '10',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Verifikasi Revisi Bukti Pembayaran',
                'log_type' => 'added new applicant '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '11',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $this->admin_model->insert_app_status($data2,$condition);

             $data3 = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '12',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $this->admin_model->insert_app_status($data3,$condition);

            $data6 = array(
                    'type' => 'BILLING',
                    'value' => 'SUCCEST',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data6);
    }


	public function VERIF_PAY_REQ($id_application_status)
	{
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('admin_konfirmasi_assessment_lapangan', $data);
	}





    public function assesment_application()
    {
        $data = array(
            'id_application' => $this->input->post('id_application'),
            'assessment_date' => $this->input->post('assessment_date'),
            'assessment_status' => $this->input->post('assessment_status'),
            'created_date' => $this->input->post('created_date'),
            'created_by' => $this->input->post('created_by')
            );

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' adding new assesment_application',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);
            $this->admin_model->insert_assesment_application($data);     

    }

    // public function assesment_application()
    // {
    //         $data = array(
    //         'id_assessment_application' => $this->input->post('id_assessment_application'),
    //         'id_assessment_team' => $this->input->post('id_assessment_team'),
    //         'id_assessment_team_title' => $this->input->post('id_assessment_team_title')
    //         );

    //         $dataL = array(
    //             'detail_log' => $this->session->userdata('admin_role').' adding new assessment_registered',
    //             'log_type' => 'added '.$this->input->post('username'), 
    //             'created_date' => date('Y-m-j H:i:s')
    //             // 'created_by' => $this->session->userdata('username')
    //             );
    //         $this->admin_model->insert_log($dataL);
    //         $this->admin_model->insert_assessment_registered($data);     
    // }









	public function VERIF_PAY_REQ_SUCCEST()
	{

       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		 'process_status' => 'COMPLETED',
                'id_application_status_name' => '9',        		
      			'created_date' => date('Y-m-j'),
      			'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Verifikasi Pembayaran',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

        	$this->admin_model->next_step($data,$condition);

                $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '10',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data2,$condition);

            $data3 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '11',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data3,$condition);

             $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '12',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data4,$condition);

            $data5 = array(
                    'type' => 'BILLING_EXPIRED',
                    'value' => 'contoh (29-08-2017)',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data5);

        	 header("refresh:0; inbox");
        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

    public function REV_ASSESS_REQ($id_application_status)
    {
         $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_hasil_assessment_lapangan', $data);
    }

    public function REV_ASSESS_REQ_PROSESS()
    {
         if($this->input->post('setujui') == "setujui")
        {   
                $data = array(
                'process_status' => '13',
                'approval_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
             $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Revisi Dokumen Hasil Assessment Lapangan',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

                $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '14',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data2,$condition);

             $data3 = array(
                    'type' => 'BILLING_EXPIRED',
                    'value' => 'contoh (29-08-2017)',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data3);


             header("refresh:0; inbox");
            
        }else
        {
            echo "bukan tombol setujui";
        }
    }

	public function FIELD_ASSESS_REQ($id_application_status)
	{
        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_hasil_assessment_lapangan', $data);
	}

	public function FIELD_ASSESS_REQ_SUCCEST()
	{
       if($this->input->post('setujui') == "setujui")
        {	
        		$data = array(
        		'process_status' => '14',
        		'approval_status' => 'COMPLETED',
      			'created_date' => date('Y-m-j'),
      			// 'created_by' => $this->session->userdata('username'),
        		'last_updated_date' => date('Y-m-j H:i:s'));

        	$condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Assessment Lapangan ',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

        	$this->admin_model->next_step($data,$condition);

        	  $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '15',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data2,$condition);

             $data3 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data3);

           $data4 = array(
                'id_application' => $this->input->post('id_application'),
                'assessment_date' => $this->input->post('assessment_date'),
                'assessment_status' => 'OPEN',
                'created_date' => date('y-mj'),
                // 'created_by' => $this->session->userdata('username'),

            );
            $this->admin_model->insert_application_file($data4);


             $data5 = array(
                    'id_document_config' => '8',
                    'path_id' => '///',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
            $this->admin_model->insert_application_file($data5);

             $data6 = array(
                    'id_application' => $this->input->post('id_application'),
                    'assessment_date' => $this->input->post('assessment_date'),
                    'assessment_status'=> 'OPEN',
                    'created_date' => date('y-m-d')
                    // 'created_by' => $this->session->username('username')
                    );
            $this->admin_model->insert_assessment_application($data6);

            $id = $this->input->post('id_application');
            $cekApp = $this->admin_model->get_assesment_application($id); 

            $id_ass_app = $cekApp->row()->id_assessment_application;

            $data7 = array(
                    'id_assessment_application' => $id_ass_app,
                    'id_assessment_team' => $this->input->post('id_assessment_team'),
                    'id_assessment_team_title'=> $this->input->post('id_assessment_team_title')
                    );
            $this->admin_model->insert_assessment_registered($data7);





        	
        }else
        {
        	echo "bukan tombol setujui";
        }
	}

    public function UPL_RES_ASSESS_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_hasil_assessment_lapangan', $data);
    }

    public function VERIF_REV_ASSESS_RES_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('admin_hasil_assessment_lapangan', $data);
    }

    public function VERIF_REV_ASSESS_RES_REQ_PROSES()
    {
        if ($this->input->post('setujui') == "setujui") {
            
            $data = array(
                'process_status' => '17',
                'approval_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
             $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Verifikasi Revisi Dokumen Hasil Assessment Lapangan ',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '18',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data2,$condition);

            $data3 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data3);

        }elseif ($this->input->post('tolak') == "tolak") {
            $data = array(
                'process_status' => '17',
                'approval_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '16',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data2,$condition);

            $data3 = array(
                    'type' => 'REVISED_DOC',
                    'value' => '(nama document atau id document)',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data3);


        }
    }


    public function UPL_RES_ASSESS_REQ_SUCCESS()
    {
        if ($this->input->post('setujui') == "setujui") {
            
            $data = array(
                'process_status' => '15',
                'approval_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Hasil Assessment Lapangan ',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '16',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data2,$condition);

             $data3 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '17',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data3,$condition);

            $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '18',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data4,$condition);

            $data5 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data5);

        }
    }

    public function CRA_APPROVAL_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('Proses Permohonan ke CRA', $data);
    }

    public function CRA_APPROVAL_REQ_PROSES()
    {
        if ($this->input->post('setujui') == "setujui") {
            
             $data = array(
                'process_status' => '18',
                'approval_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Proses Permohonan ke CRA ',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '19',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data4,$condition);

            $data5 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data5);
        }
    }

    public function UPL_IIN_DOC_REQ($id_application_status)
    {

        $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        
        $this->load->view('Proses Permohonan ke CRA', $data);
    }

    public function UPL_IIN_DOC_REQ_PROSES()
    {
         $data = array(
                'process_status' => '19',
                'approval_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Upload Dokumen IIN  ',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data5 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data5);
    }   


}