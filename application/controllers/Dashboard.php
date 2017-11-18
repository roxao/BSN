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

    public function notif(){
        if($this->input->get('id_notif')){
            $id_notif = $this->input->get('id_notif');
            $result = $this->admin_model->get_data_notif($id_notif);
            if($result) 
                redirect(base_url('dashboard?application=' . $result['id_notification']));
            else 
                echo '<script>alert("Rinaldy Sam Ganteng")</script>';
                // redirect(base_url('dashboard'));
        } else {
            redirect(base_url('dashboard'));
        }
    }

    public function ntest(){
        if($this->input->get('id_notif')){
            $id_notif = $this->input->get('id_notif');
            $result = $this->admin_model->get_notif()->result_array();
            echo json_encode($result);
            return false;
            if($result) 
                echo json_encode($result);
                // redirect(base_url('dashboard?application=' . $result->id_notification));
            else 
                echo '<script>alert("Rinaldy Sam Ganteng")</script>';
                // redirect(base_url('dashboard'));
        } else {
            redirect(base_url('dashboard'));
        }

    }

    public function index(){
        $this->user('check-autho');
        if($this->input->get('application')){
            $data['notif_result'] = $this->input->get('application');
        }
        $this->load->view('admin/header');
        $data['notification'] = $this->admin_model->get_notif()->result_array();
        $data['applications'] = $this->admin_model->get_applications()->result();
        $this->load->view('admin/inbox', $data);
    }

    public function iinlist(){
        $this->user('check-autho');
        $data['applications'] = $this->admin_model->get_applications_finish()->result();
        $this->load->view('admin/header');
        $this->load->view('admin/iin-list', $data);
    }
    public function data_entry(){
        $this->user('check-autho');
        $data['applications'] = $this->admin_model->get_applications_finish()->result();
        $this->load->view('admin/header');
        $this->load->view('admin/data-entry', $data);
    }

    public function data_entry_form(){
        $this->user('check-autho');
        $data['applications'] = $this->admin_model->get_applications_finish()->result();
        $this->load->view('admin/header');
        $this->load->view('admin/data-entry-form', $data);
    }

    public function extend(){
        $this->user('check-autho');
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications_ext()->result();
        $this->load->view('admin/extend', $data);
    }

    public function submission(){
        $this->user('check-autho');
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications_new()->result();
        $this->load->view('admin/submission', $data);
    }

     public function report(){
        $this->user('check-autho');
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications()->result_array();
        $this->load->view('admin/report', $data);
    }




    public function user($subparams = null) {
        switch ($subparams) {
            case 'login':
                print_r($this->session->userdata('admin_status'));
                $this->load->view('admin/login');
                break;
            case 'register':
                $this->load->view('admin/register');
                break;
            case 'logout':
                $array_items = array('id_admin','username','email','admin_status','admin_role');
                $this->session->unset_userdata($array_items);
                $this->session->sess_destroy('sipin_cookies');
                redirect(base_url('dashboard/user/login'));
                break;
            case 'authorize':
                $username = $this->input->post('username');
                $password = hash ( "sha256", $this->input->post('password'));
                $cek = $this->admin_model->cek_login($username,$password);
                if($cek->num_rows() > 0){
                    if ($cek->row()->admin_status == "INACTIVE"){ 
                        redirect(base_url('dashboard/user/login'));
                       
                    } else {
                        $this->session->set_userdata(array(
                            'id_admin'      => $cek->row()->id_admin,
                            'admin_username'=> $cek->row()->username,
                            'admin_email'   => $cek->row()->email,
                            'admin_status'  => $cek->row()->admin_status,
                            'status' => 'login',
                            'admin_role'    => $cek->row()->admin_role));
                        redirect(base_url('dashboard'));
                    }
                }
                else{
                    redirect(base_url('dashboard/user/login'));
                }
                break;
            case 'check-autho':
                if (!($this->session->userdata('admin_status'))){
                    redirect(base_url('dashboard/user/login'));
                }
                return false;
                break;
            case null:
                redirect(base_url('dashboard/user/login'));
                break;       
        }
    }

    public function test(){
        echo json_encode($this->admin_model->get_instance_list('PT')->result());
    }

    public function get_app_data() {    
        $this->user('check-autho');
        $id = $this->input->post('id_app');
        $id_status = $this->input->post('id_status');
        $step = $this->input->post('step'); 
        if($id!=null){
            $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
            switch ($step) {
                case 'verif_new_req':
                case 'upl_res_assess_req':
                case 'field_assess_req':
                case 'upl_bill_req':
                case 'upl_iin_doc_req':
                case 'reupl_bill_req':
                    break; 
                case 'verif_pay_req':
                case 'verif_rev_pay_req':
                    $data['doc_pay'] = $this->admin_model->get_pay($id)->result();
                    $data['assessment_roles'] = $this->admin_model->get_assessment_team_title()->result();
                    break;
                case 'verif_revdoc_req':
                    $data['revdoc_user'] = $this->admin_model->application_status_form_mapping_rev_by_idapp($id,$id_status)->result();
                    break;  
                case 'verif_upldoc_req':
                    $data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
                    break;
                case 'rev_assess_req':
                    $data['date_req'] = $this->admin_model->get_date_rev($id_status)->result();
                    $data['assessment_roles'] = $this->admin_model->get_assessment_team_title()->result();
                    break;  
                case 'verif_rev_assess_res_req':
                $data['doc_user'] = $this->admin_model->get_revised_resuld_assessment($id,$id_status)->result();
                    break;    
                case 'cra_approval_req':
                    $data['revdoc_user'] = $this->admin_model->get_doc_cra()->result();
                    break;  
                default:
                    return false;
                    break;
            }
            echo json_encode($data);
        }
    }

    public function get_autocomplete($step){
        $result =  array();
        switch ($step) {
            case 'assessment_team':
                foreach($this->admin_model->get_assessment_team($this->input->get('term'))->result_array() as $key):
                    $result[] = array(
                        'label'   => trim($key['name']),
                        'id_team' => trim($key['id_assessment_team'])
                    );
                endforeach;
                break; 
            case 'doc':
                foreach($this->admin_model->get_document_by_display($this->input->get('term'))->result_array() as $key):
                    $result[] = array(
                        'label'   => trim($key['display_name']),
                        'id_doc' => trim($key['id_document_config'])
                    );
                endforeach;
                break;  
            case 'instance_name':
                foreach($this->admin_model->get_instance_list($this->input->get('term'))->result_array() as $key):
                    $result[] = array(
                        'label'   => trim($key['instance_name'])
                        // 'id_doc' => trim($key['id_document_config'])
                    );
                endforeach;
                break;  
        }
        echo json_encode($result);
    }


    public function set_view($param = null, $subparams = null) {
        $this->load->view('admin/'.$param.'/'.$subparams);
    }

    public function settings($param = null){
        switch ($param) {
            case 'user': 
                $data['data'] = $this->admin_model->get_user()->result_array(); break;
            case 'admin': 
                $data['data'] = $this->admin_model->get_admin()->result_array(); break;
            case 'assessment': 
                $data['data_name'] = $this->admin_model->get_assessment()->result_array(); break;
                $data['data_title'] = $this->admin_model->get_assessment_title()->result_array(); break;
            case 'document_dynamic': 
                $data['data'] = $this->admin_model->get_document_config('DYNAMIC')->result_array(); break;
            case 'document_static': 
                $data['data'] = $this->admin_model->get_document_config('STATIC')->result_array(); break;
            case 'cms': 
                $data['data'] = $this->admin_model->get_cms()->result_array(); break;
            case 'cms_editor':
                $data['data'] = $this->admin_model->get_cms_by_prm('1')->result_array();
                break;
            case 'iin': 
                $data['data'] = $this->admin_model->get_iin()->result_array(); break;
            case 'survey':
                $data['data'] = $this->admin_model->question_survey_question()->result_array(); break;
            default: 
                redirect(base_url()); break;
        }
        // echo json_encode($data);
        // return false;
        $this->load->view('admin/header');
        $this->load->view('admin/settings/'.$param ,$data);
    }

    public function action_update($param){
        switch ($param) {
            case 'admin':
                $condition = array('id_admin' => $this->input->post('id_admin'));
                $data = array(
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    // 'password' => $this->input->post('password'),
                    'password' => hash ( "sha256", $this->input->post('password')),
                    'admin_status' => $this->input->post('admin_status'),
                    'admin_role' => $this->input->post('admin_role'),
                    'modified_date' => date('Y-m-j'),
                    // 'modified_by' => $this->session->userdata('username')                
                );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' Update Data Admin',
                    'log_type' => 'Update Data '.$this->input->post('username'), 
                    'created_date' => date('Y-m-j H:i:s')
                    // 'created_by' => $this->session->userdata('username')
                );
                $this->admin_model->update_admin($condition,$data);
                break;
            case 'assessment':
                $condition = array('id_assessment_team' => $this->input->post('id_assessment_team'));
                $data = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),               
                );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' Update Data assesment team',
                    'log_type' => 'Update Data '.$this->input->post('name'), 
                    'created_date' => date('Y-m-j H:i:s')
                    // 'created_by' => $this->session->userdata('username')
                );
                $this->admin_model->update_assessment($condition,$data);
                break;
            case 'document':
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "allowed_types" => "gif|jpg|png|jpeg|png",
                    "upload_path"   => "./upload/"
                ));
                
                $this->upload->do_upload("file_url");
                $uploaded = $this->upload->data();
            
                $condition = array('id_document_config' => $this->input->post('id_document_config'));
                $data = array(
                    'type' => $this->input->post('type'),
                    'key' => $this->input->post('key'),
                    'display_name' => $this->input->post('display_name'),
                    'file_url' => $uploaded['full_path'],
                    'mandatory' => $this->input->post('mandatory'),
                    'modified_date' => date('Y-m-j H:i:s'),
                    // 'modified_by' => $this->session->userdata('username')                
                );
                $log = array(
                'detail_log' => $this->session->userdata('admin_role').' Update Data Dokumen',
                'log_type' => 'Update Data '.$this->input->post('display_name'), 
                'created_date' => date('Y-m-j H:i:s')
                // 'created_by' => $this->session->userdata('username')
                );
                $this->admin_model->update_documenet_config($condition,$data);
                break;
            case 'contents':
                $condition = array('id_cms' => $this->input->post('id_cms'));
                $data = array(
                    'content' => $this->input->post('content'),
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'modified_date' => date('Y-m-j H:i:s'),
                    // 'modified_by' => $this->session->userdata('username')                
                );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' Update Data CMS',
                    'log_type' => 'Update Data '.$this->input->post('title'), 
                    'created_date' => date('Y-m-j H:i:s')
                    // 'created_by' => $this->session->userdata('username')
                );
                $this->admin_model->update_cms($condition,$data);
                break;
            case 'iin':
                $condition = array('id_iin' => $this->input->post('id_iin'));
                $data = array(
                    'id_user' => $this->input->post('id_user'),
                    'iin_number' => $this->input->post('iin_number'),
                    'iin_established_date' => date('Y-m-j H:i:s'),
                    'iin_expiry_date' => date('Y-m-j H:i:s'),
                    'modified_date' => date('Y-m-j H:i:s')
                    // 'modified_by' => $this->session->userdata('username')     
                );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' Update Data IIN',
                    'log_type' => 'Update Data '.$this->input->post('iin_number'), 
                    'created_date' => date('Y-m-j H:i:s')
                    // 'created_by' => $this->session->userdata('username')
                );
                $this->admin_model->update_iin($condition,$data);
                break;
            default:
                break;
        }
        $this->admin_model->insert_log($log);
        redirect(base_url('dashboard/settings/'.$param));
    }

    public function action_insert($param){
        switch ($param) {
            case 'admin':
                $data = array(
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    // 'password' => $this->input->post('password'),
                    'password' => hash ( "sha256", $this->input->post('password')),
                    'admin_status' => $this->input->post('admin_status'),
                    'admin_role' => $this->input->post('admin_role'),
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')             
                    );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' adding new admin',
                    'log_type' => 'added '.$this->input->post('username'), 
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')
                );
                $this->admin_model->insert_admin($data);
                break;
            case 'assessment':
                $data = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('STATUS'),
                    );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' adding new tim_asesment',
                    'log_type' => 'added '.$this->input->post('name'), 
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')
                    );
                $this->admin_model->insert_assesment($data);
                break;
            case 'assessment_roles':
                $data = array(
                    'title' => $this->input->post('title')
                    );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' adding new asesment title',
                    'log_type' => 'added '.$this->input->post('name'), 
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')
                    );
                $this->admin_model->insert_assesment_title($data);    
                break;
            case 'document':
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "allowed_types" => "gif|jpg|png|jpeg|png|doc|docx|pdf",
                    "upload_path"   => "./upload/"
                    ));   
                $this->upload->do_upload("file_url");
                $uploaded = $this->upload->data();

                $data = array(
                    'type' => $this->input->post('type'),
                    'key' => $this->input->post('key'),
                    'display_name' => $this->input->post('display_name'),
                    'file_url' => $this->input->post('file_url'),
                    'mandatory' => $this->input->post('mandatory'),
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')             
                    );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' adding new doc',
                    'log_type' => 'added '.$this->input->post('display_name'), 
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')
                );
                $this->admin_model->insert_document_config($data);
                break;
            case 'contents':
                $data = array(
                    'content' => $this->input->post('content'),
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')             
                    );
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' adding new cms',
                    'log_type' => 'added '.$this->input->post('title'), 
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')
                    );
                $this->admin_model->insert_cms($data); 
                break;
            case 'iin':
                $data = array(
                    'id_user' => $this->input->post('id_user'),
                    'iin_number' => $this->input->post('iin_number'),
                    'iin_established_date' => date('Y-m-j H:i:s'),
                    'iin_expiry_date' => date('Y-m-j H:i:s'),
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('username')             
                    );  
                $log = array(
                    'detail_log' => $this->session->userdata('admin_role').' adding new IIN',
                    'log_type' => 'added IIN '.$this->input->post('iin_number'), 
                    'created_date' => date('Y-m-j H:i:s'),
                    'created_by' => $this->session->userdata('admin_username')
                    );
                $this->admin_model->insert_iin($data);
                break;
            default:
                break;
        }
        $this->admin_model->insert_log($log);
        redirect(base_url('dashboard/settings/'.$param));
    }

    public function excel(){
            $this->load->library("PHPExcel");
            $objPHPExcel = new PHPExcel();
            $c= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $f=explode("||", $this->input->get('f'));
            $t=explode("||", $this->input->get('t'));
            $m=$this->input->get('m');
            $data = $this->admin_model->$m()->result_array();          
            for ($i=0; $i < count($f); $i++) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($c[$i] . 1, $t[$i]);
                for($j=0; $j < count($data); $j++) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($c[$i] . ($j+2), $data[$j][$f[$i]]);
                }
            } 
            $objPHPExcel->getActiveSheet()->setTitle('Report'.date('-Y-m-j--H-i-s'));        
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="export'.date('-Y-m-j--H-i-s').'.xls"');
            $objWriter->save("php://output");
    }

    public function upload_acceptor(){
          $imageFolder = "upload/content-file/";
          reset ($_FILES);
          $temp = current($_FILES);
          if (is_uploaded_file($temp['tmp_name'])){
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.0 500 Invalid file name.");
                return;
            }

            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.0 500 Invalid extension.");
                return;
            }
            $filename = date('ymjHis'). '-' .$temp['name'];
            $filetowrite = $imageFolder . $filename;
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            $data = array(
                'file_name' => $filename,
                'path_file' => base_url().$imageFolder,
                'created_date' => date('y-m-d'),
                'created_by' => $this->session->userdata('admin_username'));
            $this->admin_model->insert_cms_file($data);

            $dataL = array(
                'detail_log' => $this->session->userdata('admin_username').' Upload File for CMS',
                'log_type' => 'Update Data', 
                'created_date' => date('Y-m-j H:i:s')
            );

            $this->admin_model->insert_log($dataL);

            echo json_encode(array('location' => base_url() . '/' .$filetowrite));
          } else {
            header("HTTP/1.0 500 Server Error");
          }
    }



















































    
















    

    function do_upload() {
        $this->load->library('upload');
        $this->upload->initialize(array("allowed_types" => "gif|jpg|png|jpeg|pdf|doc", "upload_path" => "./upload/"));
        //Perform upload.
        if($this->upload->do_upload("images")) {
            echo '<script>console.log('.var_export($this->upload->data()).');</script>';

            $admin_name     = 'Rinaldy Sam';
            $doc_step       = 'verif_upldoc_req';
            $doc_step_name  = 'Verifikasi Kelengkapan Dokumen';
            /*Insert Log document Revisi*/
            // write_log($admin_name, $doc_step, 'do upload documents');
            // $upload_data = array(
            //     'id_application '=> $get_documen->row->id_application,
            //     'id_application_status_name' => $doc_step,
            //     'process_status' => 'PENDING',
            //     'approval_date' => 'null',
            //     'created_date' => date('Y-m-j'),
            //     'created_by' => $username,
            //     'modified_by' => $username,
            //     'last_updated_date' => date('Y-m-j'));
            // $this->admin_model->insert_app_status($upload_data);
        } else {
            die('GAGAL UPLOAD');
      }
    }




    //cari iin berdasarkan id iin
    public function get_iin($prm) {
        $data['iin'] = $this->admin_model->get_iin_by_prm($prm)->result();
        $this->load->view('admin/options/iin_edit', $data);
        // echo json_encode($data);
    }

    //edit data iin
    public function iin_edit_proses()
    {
        $condition = array('id_iin' => $this->input->post('id_iin'));
        $data = array(
        'id_user' => $this->input->post('id_user'),
        'iin_number' => $this->input->post('iin_number'),
        'iin_established_date' => date('Y-m-j H:i:s'),
        'iin_expiry_date' => date('Y-m-j H:i:s'),
        'modified_date' => date('Y-m-j H:i:s')
        // 'modified_by' => $this->session->userdata('username')                
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' Update Data IIN',
        'log_type' => 'Update Data '.$this->input->post('iin_number'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

        $this->admin_model->insert_log($dataL);
        $this->admin_model->update_iin($condition,$data);

    }

    //tambah iin
    public function insert_iin_proses()
    {      
        $data = array(
        'id_user' => $this->input->post('id_user'),
        'iin_number' => $this->input->post('iin_number'),
        'iin_established_date' => date('Y-m-j H:i:s'),
        'iin_expiry_date' => date('Y-m-j H:i:s'),
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')             
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' adding new IIN',
        'log_type' => 'added IIN '.$this->input->post('iin_number'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

          $this->admin_model->insert_log($dataL);
          $this->admin_model->insert_iin($data);
          $this->get_iin_data();    
    }


    // menampilkan user yang komplain
    public function get_complain_data()
    {
        $data['compalin'] = $this->admin_model->get_conplain()->result();
        echo json_encode($data);
    }


}
