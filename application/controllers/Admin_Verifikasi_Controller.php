<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Verifikasi_Controller extends CI_Controller 
{


	public function __construct() 
	{
		
		parent::__construct();
		$this->load->library('session', 'upload');
	    $this->load->helper(array('captcha','url','form'));
		$this->load->model('admin_model');
		$this->load->library('email');
		$this->load->helper('form'); 
		$this->load->database();
		$this->load->model('admin_model','adm_model');
        $this->load->model('user_model','usr_model');
      
	}

    //proses pertama
    public function VERIF_NEW_REQ($id_application_status)
    {

        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('admin_pengajuan_permohonan', $data);
    }

    //proses pertama setujui permohonan baru
    public function VERIF_NEW_REQ_PROSES()
    {
            //untuk menapilkan nama applicant yang akan disimpan di tabel log
        $id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
      
                $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' adding new applicant',
                'log_type' => 'added new applicant '..$id_app->row()->applicant, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

                $data2 = array(
                'id_application'=> $this->input->post('id_application'),
                'id_application_status_name' => '2',
                'process_status ' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'),
                'modified_by ' => $this->session->userdata('username')
                );
            
            $this->admin_model->insert_app_status($data2);

            $data4 = array(
                    'type' => 'APPROVED',
                    'value' => 'APPROVED'
                    );
            $this->admin_model->insert_app_sts_for_map($data4);
            //insert document ke app file di hapus karena user yang insert
            // $this->get_doc($this->input->post('id_application'));

                $this->send_mail($this->input->post('id_application'));
             redirect(site_url('dashboard'));
            
        
    }


    //tolak pengajuan karena kesalahan sesuatu
    public function VERIF_NEW_REQ_ETC()
    {
  
         // ditolak dll

        //untuk menapilkan nama applicant yang akan disimpan di tabel log
        $id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
        echo $id_app->row()->applicant;
            $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'modified_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Rejected new applicant',
                'log_type' => 'reject new applicant '.$id_app->row()->applicant, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
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

  

                $data4 = array(
                    'type' => 'REJECTED',
                    'value' => $this->input->post('coment'),
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
            $this->admin_model->insert_app_sts_for_map($data4);
                    
                    $data5 = array(
                        'iin_status'=> 'CLOSED');
            $id_application = array('id_application'=> $this->input->post('id_application'));
            $this->admin_model->update_applications($data5,$id_application);
           redirect(base_url('dashboard'));
        
    }
























    public function VERIF_UPLDOC_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_application_file($id_application_status)->result();
        // echo json_encode($data);
        $this->load->view('admin_cek_upload_document', $data);
    }

//setujui kelemngkapan document dari user
    public function VERIF_UPLDOC_REQ_PROSES_SUCCEST()
    {
            //untuk menapilkan nama applicant yang akan disimpan di tabel log
        $id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
            $data = array(
                'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                // 'id_application_status_name' => '3',
              
                'created_date' => date('Y-m-j'),
                // 'modified_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            echo $this->input->post('id_application_status')." = id_application_status";
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' approved new document',
                'log_type' => 'added '.$id_app->row()->applicant, 
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
                    'type' => 'APPROVED',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data2);
           redirect(base_url('dashboard'));

    }

//revisi document untuk user
    public function VERIF_UPLDOC_REQ_PROSES_REVITIONS()
    {
            //untuk menapilkan nama applicant yang akan disimpan di tabel log
        $id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
            $data = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '3',
              
                'created_date' => date('Y-m-j'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Revisi Kelengkapan Dokumen',
                'log_type' => 'revisi '.$id_app->row()->applicant, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

             $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '4',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $id_app_st = $this->admin_model->insert_app_status($data4);


           //update data

             $doc = $this->input->post("docRef");

             for ($i=0; $i < count($doc); $i++) { 
                    //untuk mendapatkan id_document_config
                    $dc = $this->admin_model->document_config_get_by_prm_key($doc[$i]);

                    //app file search dgn 2 parameter yaitu id_application dan id_document_config
                    $apf = $this->admin_model->application_file_get_by_idapp_iddc($this->input->post('id_application'),$dc->row()->id_document_config);

                    //data untuk insert ke tabel applications_form_mapping
                    if(!$doc[$i] == null)
                    {
                        $data2 = array(
                        'type' => 'REVISED_DOC '.$doc[$i],
                        'value' => $doc[$i],
                        'id_application_status'=> $id_app_st
                        );
                        //insert ke tabel application form mapping
                         $this->admin_model->insert_app_sts_for_map($data2);

                        $id_app_file = array('id_application_file' => $apf->row()->id_application_file);
                        
                        $data3 = array(
                            'status' => 'INACTIVE',
                            'modified_date' => date('y-m-d'),
                            'modified_by' => $this->session->userdata('username')
                        );
                        //update applications file untuk direfisi
                        $this->admin_model->application_file_update($id_app_file, $data3);

                    }
             }

            redirect(base_url('dashboard'));
    }

   


   public function VERIF_REVDOC_REQ($id_application_status)
   {
        $data['aplication_setujui'] = $this->admin_model->get_application_file($id_application_status)->result();
        // echo json_encode($data);
        $this->load->view('admin_cek_revisi_upload_document', $data);
   }

//revisi dokumen disetujui
   public function VERIF_REVDOC_REQ_PROSES()
   {
            
            $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'modified_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' approve revisi dokumen',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

                $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '6',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data2,$condition);
            
             $data3 = array(
                    'type' => 'APPROVED',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data3);    
            redirect(base_url('dashboard'));

   }

//revisi dokumen kembali jika ada kesalahan dokumen 
   public function VERIF_REVDOC_REQ_REVITION()
   {
        
            $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' revisi dokumen',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

                $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '4',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $id_app_sts = $this->admin_model->insert_app_status($data2,$condition);
            
           //update data

             $doc = $this->input->post("docRef");

             for ($i=0; $i < count($doc); $i++) { 
                    //untuk mendapatkan id_document_config
                    $dc = $this->admin_model->document_config_get_by_prm_key($doc[$i]);

                    //app file search dgn 2 parameter yaitu id_application dan id_document_config
                    $apf = $this->admin_model->application_file_get_by_idapp_iddc($this->input->post('id_application'),$dc->row()->id_document_config);
                    echo json_encode($dc->row()->id_document_config) ;
                    //data untuk insert ke tabel applications_form_mapping
                    if(!$doc[$i] == null)
                    {
                        $data2 = array(
                        'type' => 'REVISED_DOC '.$doc[$i],
                        'value' => $doc[$i],
                        'id_application_status'=> $id_app_sts
                        );
                        //insert ke tabel application form mapping
                         $this->admin_model->insert_app_sts_for_map($data2);

                        $id_app_file = array('id_application_file' => $apf->row()->id_application_file);
                        
                        $data3 = array(
                            'status' => 'INACTIVE',
                            'modified_date' => date('y-m-d'),
                            'modified_by' => $this->session->userdata('username')
                        );
                        //update applications file untuk direfisi
                        $this->admin_model->application_file_update($id_app_file, $data3);

                    }
             }

            redirect(base_url('dashboard')); 
            
 
   }





















    public function UPL_BILL_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('admin_upload_biling_code_simponi', $data);
    }
//mengupload biling
    public function UPL_BILL_REQ_SUCCEST()
    {  
        
            
                $data = array(
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '6',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Upload Billing Code SIMPONI',
                'log_type' => 'added '.$this->input->post('username'), 
                'log_type' => 'added by : ', 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);
            $this->admin_model->next_step($data,$condition);

             $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '7',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $this->admin_model->insert_app_status($data2,$condition);

            $data3 = array(
                'id_application' => $this->input->post('id_application'),
                'id_document_config'=> '23',
                'path_id'=> '/',
                'status' => 'ACTIVE'
                );

            // $this->admin_model->insert_application_file($data3);

            $data4 = array(
                    'type' => $this->input->post('app_bill_code'),
                    'value' => $this->input->post('expired_date'),
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data4);



            $this->load->library('upload');
            $cek = $this->input->post("bill");
            $getDoc = $this->admin_model->get_doc_bill_res()->result();
           

            $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|pdf|doc|docx",
                 "upload_path"   => "./upload/"
             ));

            if($this->upload->do_upload("bill"))
                {
                    $uploaded = $this->upload->data();     
           
                for($x=0;$x < count($getDoc);$x++)
                {
                    for($y=0;$y < count($getDoc);$y++)
                    {
                        if($x == $y)
                        {
                    $doc = array(
                    'id_application' => $this->input->post('id_application'),
                    'id_document_config' => $getDoc[$x]->id_document_config,
                    'status' => 'ACTIVE',
                    'created_date'=> date('y-m-d'),
                    'path_id' => $uploaded[$x]['full_path'],
                    'created_by' => $this->session->userdata('username')
                                );

                    $uploaded = $this->upload->data();
                    $this->admin_model->insert_doc_for_user($doc);
                   
                    

                        }

                    }
                }
           
                }
             
            redirect(base_url('dashboard'));       
  
    }


//yg ini belum
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















    public function VERIF_PAY_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        // $this->load->view('admin_konfirmasi_assessment_lapangan', $data);
        $this->load->view('cek_bukti_transfer', $data);
    }

//bukti pembayaran diterima dan 
    public function VERIF_PAY_REQ_SUCCEST()
    {
        $usr_id = $this->admin_model->get_user_application_data($this->input->post('id_application'));
        $usrnme = $this->admin_model->get_user_by_prm($usr_id->row()->id_user);
        
            $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

        

        $condition = array('id_application_status' => $this->input->post('id_application_status'));
           
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' verif bukti pembayaran',
                'log_type' => 'added new applicant '.$usrnme->row()->username, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            
        $this->admin_model->insert_log($dataL);

        $this->admin_model->next_step($data,$condition);

            $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '10',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
   
        $this->admin_model->insert_app_status($data2);

            $data3 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '11',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
        $this->admin_model->insert_app_status($data3);

            $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '12',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
        $this->admin_model->insert_app_status($data4);

            $data5 = array(
                    'type' => 'APPROVED',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );

        $this->admin_model->insert_app_sts_for_map($data5);

            $dataL2 = array(
                'detail_log' => $this->session->userdata('admin_role').' memillih team assessment',
                'log_type' => 'added new team_assessment '.$usrnme->row()->username, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );

        $this->admin_model->insert_log($dataL2);

            $data_ass_app = array(
                'id_application' => $this->input->post('id_application'),
                'assessment_date' => $this->input->post('expired_date'),
                'assessment_status' => 'OPEN',
                'created_date' => date('y-m-d'),
                'created_by' => $this->session->userdata('username')
                );

            $dataLass = array(
                'detail_log' => $this->session->userdata('admin_role').' adding new assesment_application',
                'log_type' => 'added '.$usrnme->row()->username, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );

        $this->admin_model->insert_log($dataLass);

            $id_ass_app =  $this->admin_model->insert_assessment_application($data_ass_app);



            $team = $this->input->post('a_names');
            $title = $this->input->post('a_roles');
            
            

            for($x=0;$x < count($team);$x++){
                    $dat = array(
                    'id_assessment_application' => $id_ass_app,
                    'id_assessment_team' => $team[$x],
                    'id_assessment_team_title' => $title[$x]
                                );

                    $this->admin_model->insert_assessment_registered($dat);
                }
        $this->load->library('upload');
 
        //Configure upload.
        $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
                 "upload_path"   => "./upload/"
                ));

            $getLetterAssigment = $this->admin_model->get_letter_of_assignment();
             //Perform upload.
            if($this->upload->do_upload("images")) {
                $uploaded = $this->upload->data();
                
                $data6 = array(
                'id_document_config' => $getLetterAssigment->row()->id_document_config,
                'id_application' => $this->input->post('id_application'),
                'path_id' =>  $uploaded['full_path'],
                'status' => 'ACTIVE',
                'created_date' => date('y-m-d')
                // 'created_by' => ''
                );

                $this->admin_model->insert_application_file($data6);

              } 
            redirect(site_url('dashboard'));
    }
        

    


    //bukti pembayaran revisi
    public function VERIF_PAY_REQ_REVISI()
    {       
        
        $usr_id = $this->admin_model->get_user_application_data($this->input->post('id_application'));
        $usrnme = $this->admin_model->get_user_by_prm($usr_id->row()->id_user);
        
         //untuk menapilkan nama applicant yang akan disimpan di tabel log
            $id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
            $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' revisi bukti pembayaran',
                'log_type' => 'added new applicant '.$usrnme->row()->username, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '10',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data2,$condition);

            //pengecekan bukti transaksi dari user
            $cek = $this->admin_model->application_file_get_transaction($this->input->post('id_application'));

            $data3 = array(
                'status' => 'INACTIVE',
                'modified_by' => $this->session->userdata('username'),
                'modified_date' => date('Y-m-j')
                );
            $id_app_file = array('id_application_file' => $cek->row()->id_application_file);
            $this->admin_model->application_file_update($id_app_file,$data3);

            $data4 = array(
                'type' => 'REJECTED Bukti Transfer',
                'value' => $this->input->post('coment'),
                'id_application_status'=> $this->input->post('id_application_status')
                );
                
            $this->admin_model->insert_app_sts_for_map($data4);

            redirect(site_url('dashboard'));


    }
























































    public function VERIF_REV_PAY_REQ($id_application_status)
    {
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        // $this->load->view('admin_konfirmasi_assessment_lapangan', $data);
        $this->load->view('cek_bukti_revisi_transfer', $data);
    }
//bukti revisi pembayaran di terima
    public function VERIF_REV_PAY_REQ_SUCCEST()
    {   
            $data = array(
                'process_status' => 'COMPLETED',
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
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '14',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data2,$condition);

            $data6 = array(
                    'type' => 'BILLING',
                    'value' => 'SUCCEST',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
            $this->admin_model->insert_app_sts_for_map($data6);

            $dataL2 = array(
                'detail_log' => $this->session->userdata('admin_role').' memillih team assessment',
                'log_type' => 'added new team_assessment '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            // $this->admin_model->insert_log($dataL2);

            $data_ass_app = array(
            'id_application' => $this->input->post('id_application'),
            'assessment_date' => $this->input->post('expired_date'),
            'assessment_date' => '2017-12-12',
            'assessment_status' => 'OPEN',
            'created_date' => date('y-m-d'),
            'created_by' => $this->session->userdata('username')
            );

            $dataLass = array(
                'detail_log' => $this->session->userdata('admin_role').' adding new assesment_application',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataLass);

           $id_ass_app =  $this->admin_model->insert_assessment_application($data_ass_app);

            $team = $this->input->post('id_assessment_team');
            $title = $this->input->post('id_assessment_team_title');
            
            
            print_r($id_ass_app->row()->id_assessment_application);

            for($x=0;$x < count($team);$x++)
                {
                    $dat = array(
                    'id_assessment_application' => $id_ass_app.row()->id_assessment_application,
                    'id_assessment_team' => $team[$x],
                    'id_assessment_team_title' => $title[$x]
                                );

                    if($this->admin_model->insert_assessment_registered($dat))
                    {
                        echo "save  Sucses";
                    }
                }

        $this->load->library('upload');
 
        //Configure upload.
        $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
                 "upload_path"   => "./upload/"
                ));

            $getLetterAssigment = $this->admin_model->get_letter_of_assignment();
             //Perform upload.
            if($this->upload->do_upload("images")) {
                $uploaded = $this->upload->data();
                
                $data6 = array(
                'id_document_config' => $getLetterAssigment->row()->id_document_config,
                'id_application' => $this->input->post('id_application'),
                'path_id' =>  $uploaded['full_path'],
                'status' => 'ACTIVE',
                'created_date' => date('y-m-d')
                // 'created_by' => ''
                );

                $this->admin_model->insert_application_file($data6);

              } 


    }

    //revisi bukti revisi pembayaran yg direvisi
    public function VERIF_REV_PAY_REQ_REVISI()
    {
        
            $data = array(
                'process_status' => 'COMPLETED',
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
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '10',
             
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
            $this->admin_model->insert_app_status($data2,$condition);

            $data6 = array(
                    'type' => 'BILLING',
                    'value' => 'Revisi',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data6);

           echo "sukses revisi";

        
    }























































































































































	public function FIELD_ASSESS_REQ($id_application_status)
	{
        // $data['aplication_setujui'] = $this->admin_model->get_aplication_status($id_application_status)->result();
        $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        echo json_encode($data);
        $this->load->view('input_tim_asesmen', $data);
	}

    //input dokumen penugasan tim asesment dan tgl asesment
	public function FIELD_ASSESS_REQ_SUCCEST()
	{
     	$id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
        	$data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' dokumen penugasan tim asesment',
                'log_type' => 'added new applicant '.$id_app->row()->applicant, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

        	  $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '15',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $id_app_sts = $this->admin_model->insert_app_status($data2,$condition);

             $data3 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $id_app_sts
                    );
            $this->admin_model->insert_app_sts_for_map($data3);

            //upload file penugasan
            $this->load->library('upload');
 
            //Configure upload.
            $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
                 "upload_path"   => "./upload/"
                ));

            //mencari documen usulan tim asessmen lapangan dan surat informasi tim asessmen
            $getLetterAssigment = $this->admin_model->get_letter_of_assignment_SPTAL()->result();
           
             //Perform upload.
            if($this->upload->do_upload("images")) {
                $uploaded = $this->upload->data();
                
                for($y=0; $y< count($getLetterAssigment);$y++)
                {
                    $data6 = array(
                    'id_document_config' => $getLetterAssigment[$y]->id_document_config,
                    'id_application' => $this->input->post('id_application'),
                    'path_id' =>  $uploaded['full_path'],
                    'status' => 'ACTIVE',
                    'created_date' => date('y-m-d'),
                    'created_by' =>  $this->session->userdata('username')
                    );
                            
                    $this->admin_model->insert_application_file($data6);    
                }
                

              }
              redirect(site_url('dashboard')); 
   
	}











public function REV_ASSESS_REQ($id_application_status)
    {
         $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('input_revisi_tim_asesmen', $data);
    }
//input revisi tim asesmen
public function REV_ASSESS_REQ_PROSESS()
    {
           
                $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' tim asesment',
                'log_type' => 'added  '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

                $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '12',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

           
           $id_app_sts_lst = $this->admin_model->insert_app_status($data2);

             $data3 = array(
                    'type' => 'ASESSMENT_DATE',
                    'value' => 'ASESSMENT TEAM DATE '.$this->input->post('expired_date'),
                    'id_application_status'=> $id_app_sts_lst
                    );
           $this->admin_model->insert_app_sts_for_map($data3);

           $dataL2 = array(
                'detail_log' => $this->session->userdata('admin_role').' memillih team assessment',
                'log_type' => 'added new team_assessment '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL2);

           //input asessment applications

            $data_ass_app = array(
                'id_application' => $this->input->post('id_application'),
                'assessment_date' => $this->input->post('expired_date'),
                'assessment_status' => 'OPEN',
                'created_date' => date('y-m-d'),
                'created_by' => $this->session->userdata('username')
                );

            $id_ass_app =  $this->admin_model->insert_assessment_application($data_ass_app);



            $team = $this->input->post('a_names');
            $title = $this->input->post('a_roles');
            
            

            for($x=0;$x < count($team);$x++){
                    $dat = array(
                    'id_assessment_application' => $id_ass_app,
                    'id_assessment_team' => $team[$x],
                    'id_assessment_team_title' => $title[$x]
                                );

                    $this->admin_model->insert_assessment_registered($dat);
                }
        $this->load->library('upload');
 
        //Configure upload.
        $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
                 "upload_path"   => "./upload/"
                ));

            //mencari documen usulan tim asessmen lapangan dan surat informasi tim asessmen
            $getLetterAssigment = $this->admin_model->get_letter_of_assignment()->result();
           
             //Perform upload.
            if($this->upload->do_upload("images")) {
                $uploaded = $this->upload->data();
                
                for($y=0; $y< count($getLetterAssigment);$y++)
                {
                    $data6 = array(
                    'id_document_config' => $getLetterAssigment[$y]->id_document_config,
                    'id_application' => $this->input->post('id_application'),
                    'path_id' =>  $uploaded[$y]['full_path'],
                    'status' => 'ACTIVE',
                    'created_date' => date('y-m-d'),
                    'created_by' =>  $this->session->userdata('username')
                    );
                    
                    $this->admin_model->insert_application_file($data6);    
                }
                

              } 
            redirect(site_url('dashboard'));   
      
    }


























































    public function UPL_RES_ASSESS_REQ($id_application_status)
    {
         $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('hasil_asesment_lapangan', $data);
    }

    public function UPL_RES_ASSESS_REQ_SUCCESS()
    {          
            $id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
            $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Approve Hasil Asesment',
                'log_type' => 'added  '.$id_app->row()->applicant, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '16',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data2,$condition);

             $data3 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'COMPLETED',
                'id_application_status_name' => '17',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data3,$condition);

            $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '18',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data4,$condition);

            $data5 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data5);

            $this->load->library('upload');

            $docIn = $this->input->post("bill");
            $getDoc = $this->admin_model->get_news_for_user()->result();

           $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|pdf|doc|docx",
                 "upload_path"   => "./upload/"
             ));
           
            if($this->upload->do_upload("bill"))
                {
                   
                    $uploaded = $this->upload->data();     
           
                    for($x=0;$x < count($getDoc);$x++)
                    {
                        $doc = array(
                            'id_application' => $this->input->post('id_application'),
                            'id_document_config' => $getDoc[$x]->id_document_config,
                            'status' => 'ACTIVE',
                            'created_date'=> date('y-m-d'),
                            'path_id' => $uploaded[$x]['full_path'],
                            'created_by' => $this->session->userdata('username')
                        );
                       
                        $this->admin_model->insert_doc_for_user($doc);
                  
                    }

           
                }
        redirect(site_url('dashboard'));
    }

//revisi untuk hasil asessment lapangan
    public function UPL_RES_ASSESS_REQ_REVISI()
    {
             $id_app = $this->admin_model->get_applications_by_prm($this->input->post('id_application'));
            $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' hasil asesment',
                'log_type' => 'added  '.$id_app->row()->applicant, 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            // $this->admin_model->insert_log($dataL);

            // $this->admin_model->next_step($data,$condition);

            $data4 = array(
                 'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '16',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            // $id_app_sts = $this->admin_model->insert_app_status($data4,$condition);

            $display_name_doc = $this->input->post('doc');

            echo json_encode($display_name_doc);

            for($x=0;$x < length($this->input->post("doc"));$x++)
            {
                $cek_doc = $this->admin_model->get_doc_conf_by_name($display_name_doc[$x]);

                if($cek_doc->num_rows() == 0)
                {   
                    $data_doc = array(
                        'type'=> 'TRANSACTIONAL',
                        'key'=> '-',
                        'display_name'=> $display_name[$x]);
                    $id_doc_new = $this->admin_model->insert_document_config($data_doc);

                    $data5 = array(
                    'type' => 'REV_DOC_ASS '.$id_doc_new,
                    'value' => $id_doc_new,
                    'id_application_status'=> $id_app_sts
                    );
                $this->admin_model->insert_app_sts_for_map($data5);

                }else
                {
                    $data5 = array(
                    'type' => 'REV_DOC_ASS '.$cek_doc->row()->id_document_config,
                    'value' => $cek_doc->row()->id_document_config,
                    'id_application_status'=> $id_app_sts
                    );
                $this->admin_model->insert_app_sts_for_map($data5);
                }

            }


    }

































































    public function VERIF_REV_ASSESS_RES_REQ($id_application_status)
    {
         $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('rev_doc_asesmen', $data);
    }

    public function VERIF_REV_ASSESS_RES_REQ_PROSES()
    {
        
            
           $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' hasil asesment',
                'log_type' => 'added  '.$this->input->post('username'), 
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

        
    }

    public function VERIF_REV_ASSESS_RES_REQ_REVISI()
    {
       
            
           $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' revisi hasil asesment',
                'log_type' => 'added  '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

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
                    'type' => 'REJECT',
                    'value' => 'REVISI document',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data3);

        
    }














   

    public function CRA_APPROVAL_REQ($id_application_status)
    {
         $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('proses_permohonan_CRA', $data);
    }

    public function CRA_APPROVAL_REQ_PROSES()
    {
                   
               $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' CRA ',
                'log_type' => 'added  '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->next_step($data,$condition);

            $data2 = array(
                'id_application '=> $this->input->post('id_application'),
                'process_status' => 'PENDING',
                'id_application_status_name' => '19',
             
                'created_date' => date('Y-m-j'),
                'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));
           
            $this->admin_model->insert_app_status($data2,$condition);

            $data5 = array(
                    'type' => 'APPROVAL_STATUS',
                    'value' => 'APPROVED',
                    'id_application_status'=> $this->input->post('id_application_status')
                    );
           $this->admin_model->insert_app_sts_for_map($data5);

            $id_doc_conf = $this->admin_model->get_doc_cra();
            $doc = $this->input->post('doc');
            $this->load->library('upload');
            $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|pdf|doc|docx",
                "upload_path"   => "./upload/",
                "max_size"      => "10000"
             ));

            if($this->upload->do_upload("doc")){

                    $uploaded = $this->upload->data(); 

             for($x=0; $x < $id_doc_conf->num_rows(); $x++) { 
                
                        $data6 = array(
                            'id_application'=> $this->input->post('id_application'),
                            'id_document_config' => $id_doc_conf->row($x)->id_document_config,
                            'status' => 'ACTIVE',
                            'created_date' => date('y-m-d'),
                            // 'path_id' => $doc[$y],uploaded
                            'path_id' => $uploaded[$x]['full_path'],
                            'created_by' => $this->session->userdata('username')
                        );
                        //insert applications file untuk surat cra
                        $this->admin_model->insert_application_file($data6);  

                }
                        
             }

            redirect(base_url('dashboard'));


        
    }

    public function UPL_IIN_DOC_REQ($id_application_status)
    {

         $data['aplication_setujui'] = $this->admin_model->get_application($id_application_status)->result();
        
        $this->load->view('upload_iin', $data);
    }

    public function UPL_IIN_DOC_REQ_PROSES()
    {
         $data = array(
                'process_status' => 'COMPLETED',
                'created_date' => date('Y-m-j'),
                // 'created_by' => $this->session->userdata('username'),
                'last_updated_date' => date('Y-m-j H:i:s'));

            $condition = array('id_application_status' => $this->input->post('id_application_status'));
            $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' upload IIN ',
                'log_type' => 'added  '.$this->input->post('username'), 
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

            $data6 = array(
                    'id_user' => $this->input->post('id_user'),
                    'iin_number' => $this->input->post('iin_number'),
                    'iin_established_date'=> $this->input->post('iin_established_date'),
                    'iin_expiry_date' => $this->input->post('iin_expiry_date'),
                    'created_date' => date('y-m-d'),
                    'created_by' => $this->session->userdata('username')
                    );

            $id_iin = $this->admin_model->insert_iin($data6);
            

            $doc_iin = $this->admin_model->get_doc_iin();


            
            $this->load->library('upload');
            $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|pdf|doc|docx",
                "upload_path"   => "./upload/",
                "max_size"      => "10000"
             ));

            if($this->upload->do_upload("doc")){

                $uploaded = $this->upload->data(); 

                $data7 = array(
                    'id_document_config' => $doc_iin->row()->id_document_config,
                    'id_application' => $this->input->post('id_application'),
                    'path_id'=> $uploaded['full_path'],
                    'status' => 'ACTIVE',
                    'created_date' => date('y-m-d'),
                    'created_by' => $this->session->userdata('username')
                    );
            
            $this->admin_model->insert_application_file($data7);            

            }
            redirect(base_url('dashboard'));

    }   

   




    //untuk insert document type on demend
    public function insert_doc_for_user()
    {   
        $data = array(
            'type' => $this->input->post('type'),
            'key' => $this->input->post('key'),
            'display_name' => $this->input->post('display_name'),
            'file_url' => $this->input->post('file_url'),
            'mandatory' => $this->input->post('mandatory'),
            'created_date' => $this->date('y-m-d')
            // 'created_by' => $this->session->userdata('nama')

            );
        $dataL = array(
                'detail_log' => $this->session->userdata('admin_role').' Upload refisi tim asessment  ',
                'log_type' => 'added '.$this->input->post('username'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_log($dataL);

            $this->admin_model->insert_document_config($data);
    }

    public function send_mail($prm)
    {   
        
        
        $cek = $this->admin_model->get_data_for_mail($prm);
        
            // echo "jumlah ".$cek->num_rows();
            echo "email user = ".$cek->row()->email;
            echo "email kantor = ".$cek->row()->instance_email;
            echo "user name = ".$cek->row()->username;
        

       
        if($this->usr_model->sendMail($cek->row()->email,$cek->row()->username, "Please click on the below activation link to verify your email address."))
        {
             $this->usr_model->sendMail($cek->row()->instance_email,$cek->row()->username);
            echo "terkirim";
        }else
        {
            echo "tidak terkirim";
        }
    }



    public function get_doc($prm)
    {
        $query = $this->admin_model->get_doc_for_user()->result();
        // echo json_encode($data);
                    
        for($x = 0; $x < count($query); $x++)
        {
            $data = array(
                'id_application' => $prm,
                'id_document_config' => $query[$x]->id_document_config,
                'status' => 'ACTIVE',
                'created_date'=> date('y-m-d'),
                'created_by' => $this->session->userdata('username')
                );
            $this->admin_model->insert_doc_for_user($data);

        }
    }

    public function do_upload_initialize() {
        $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
                 "upload_path"   => "./upload/"
                ));
    }

}