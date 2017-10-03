<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {
// public $messagess = array();

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

    public function registered_iin(){
        // $this->session_login();
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications()->result();
        $this->load->view('admin/registered_iin', $data);
    }

     public function report(){
        // $this->session_login();
        $this->load->view('admin/header');
        $data['applications'] = $this->admin_model->get_applications()->result_array();
        $this->load->view('admin/report', $data);
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
        $id = $this->input->post('id_app');
        $id_status = $this->input->post('id_status');
        $step = $this->input->post('step');
        // echo "<script>console.log('".$log."')</script>";
        // $id = 42;
        // $id_status = 252;
        // $step = 'verif_new_req';
        if($id!=null){
            switch ($step) {
                case 'verif_new_req':
                    $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
                    echo json_encode($data);
                    break;
                case 'verif_upldoc_req':
                    $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
                    $data['doc_user'] = $this->admin_model->get_doc_user($id)->result();
                    echo json_encode($data);
                    break;
                case 'verif_revdoc_req':
                    $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
                    $data['revdoc_user'] = $this->admin_model->get_doc_user($id_status)->result();
                    echo json_encode($data);
                    break;  
                case 'upl_bill_req':
                    $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
                    echo json_encode($data);
                    break;  
                case 'reupl_bill_req':
                    $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
                    echo json_encode($data);
                    break;  
                case 'verif_pay_req':
                    $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
                    $data['doc_pay'] = $this->admin_model->get_pay($id)->result();
                    $data['assessment_list'] = $this->admin_model->get_assessment($id)->result();
                    $data['assessment_roles'] = $this->admin_model->get_doc_user($id_status)->result();
                    // $data['assesment_title'] = $this->admin_model->get_assessment_title_by_name()->result();
                    echo json_encode($data);
                    break;
                case 'verif_rev_pay_req':
                    $data['assessment_list'] = $this->admin_model->get_assessment()->result();
                    echo json_encode($data);    
                    break;
                case 'rev_assess_req':
                    $data['assessment_list'] = $this->admin_model->get_assessment()->result();
                    echo json_encode($data);
                    break;  
                case 'field_assess_req':
                    echo json_encode($data);break;  
                case 'upl_res_assess_req':
                    echo json_encode($data);
                case 'verif_rev_assess_res_req':
                    echo json_encode($data);break;  
                case 'cra_approval_req':
                    echo json_encode($data);break;  
                case 'upl_iin_doc_req':
                    echo json_encode($data);break;  
            }
        }
    }

    private function session_login(){
        $logged_in = $this->session->userdata('admin_status');
        if (!$logged_in) redirect(base_url('dashboard/user/login'));
        return false;
    }

    public function set_view($param = null, $subparams = null) {
        $this->load->view('admin/'.$param.'/'.$subparams);
    }

    public function abc() {
        $id_status = '9';
        $id=9;
        $data['application'] = $this->admin_model->get_application($id_status)->result()[0];
        $data['doc_pay'] = $this->admin_model->get_pay($id_status)->result();
        $data['assessment_list'] = $this->admin_model->get_assessment()->result();
        $data['assessment_roles'] = $this->admin_model->get_doc_user($id_status)->result();
        echo json_encode($data);
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
            write_log($admin_name, $doc_step, 'do upload documents');
            $upload_data = array(
                'id_application '=> $get_documen->row->id_application,
                'id_application_status_name' => $doc_step,
                'process_status' => 'PENDING',
                'approval_date' => 'null',
                'created_date' => date('Y-m-j'),
                'created_by' => $username,
                'modified_by' => $username,
                'last_updated_date' => date('Y-m-j'));
            $this->admin_model->insert_app_status($upload_data);
        } else {
            die('GAGAL UPLOAD');
      }
    }





//pengaturan 
     //menampilkan data tim asesment
    public function read_tim_asesment() 
    {
        $data['data_asesment'] = $this->admin_model->get_assessment()->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

     //untuk menuju form isian data tim asesment
    public function insert_tim_asesment() 
    {
        $this->load->view('');
    }

    //insert tim asesmen 
    public function insert_tim_asesment_proses()
    {      
        $data = array(
        'name' => $this->input->post('name'),
        'status' => $this->input->post('status'),
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' adding new tim_asesment',
        'log_type' => 'added '.$this->input->post('name'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

          $this->admin_model->insert_log($dataL);
          $this->admin_model->insert_assesment($data);      
    }

    //get assesmen team by id assemsent team
    public function get_tim_asesment_by_prm($prm) 
    {
        echo $prm;
        $data['data_asesment'] = $this->admin_model->get_assessment_byid($prm)->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    //edit data asesment
    public function tim_asesment_edit_proses()
    {
        $condition = array('id_assessment_team' => $this->input->post('id_assessment_team'));
        $data = array(
        'name' => $this->input->post('name'),
        'status' => $this->input->post('status'),               
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' Update Data assesment team',
        'log_type' => 'Update Data '.$this->input->post('name'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

        $this->admin_model->insert_log($dataL);
        $this->admin_model->update_assessment($condition,$data);
    }





     //menampilkan data tim asesment title
    public function read_tim_asesment_title() 
    {
        $data['data_asesment_title'] = $this->admin_model->get_assessment_title()->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    public function read_tim_asesment_title_byprm($prm) 
    {
        $data['data_asesment_title'] = $this->admin_model->get_assessment_title_byprm($prm)->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    //edit data asesment
    public function tim_asesment_title_edit_proses()
    {
        $condition = array('id_assessment_team_title' => $this->input->post('id_assessment_team_title'));
        $data = array(
        'title' => $this->input->post('title')          
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' Update Data assesment team title',
        'log_type' => 'Update Data '.$this->input->post('title'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

        $this->admin_model->insert_log($dataL);
        $this->admin_model->update_admin($condition,$data);
    }

    //untuk menuju form isian data asesment_title
    public function insert_tim_asesment_title() 
    {
        $this->load->view('');
    }

    //insert tim asesmen 
    public function insert_tim_asesment_title_proses()
    {      
        $data = array(
        'title' => $this->input->post('title')
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' adding new asesment title',
        'log_type' => 'added '.$this->input->post('name'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

          $this->admin_model->insert_log($dataL);
          $this->admin_model->insert_assesment_title($data);    
    }






    //menampilkan data admin (admin dan super admin)
    public function read_admin() 
    {
        $data['data_asesment'] = $this->admin_model->get_admin()->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    //untuk menuju form isian data tambah admin
    public function insert_admin() 
    {
        $this->load->view('admin/super_admin_insert_admin');
    }

    //tambah admin proses
    public function insert_admin_proses()
    {      
        $data = array(
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'admin_status' => $this->input->post('admin_status'),
        'admin_role' => $this->input->post('admin_role'),
        'created_date' => date('Y-m-j H:i:s'),
        // 'created_by' => $this->session->userdata('username')             
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' adding new admin',
        'log_type' => 'added '.$this->input->post('username'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

          $this->admin_model->insert_log($dataL);
          $this->admin_model->insert_admin($data);      
    }

    //cari admin berdasarkan id admin
    public function get_admin_byprm($prm) 
    {
        $data['data_asesment'] = $this->admin_model->get_admin_byprm($prm)->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    //edit data admin
    public function admin_edit_proses()
    {
        $condition = array('id_admin' => $this->input->post('id_admin'));
        $data = array(
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'admin_status' => $this->input->post('admin_status'),
        'admin_role' => $this->input->post('admin_role'),
        'modified_date' => date('Y-m-j H:i:s'),
        // 'modified_by' => $this->session->userdata('username')                
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' Update Data Admin',
        'log_type' => 'Update Data '.$this->input->post('username'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

        $this->admin_model->insert_log($dataL);
        $this->admin_model->update_admin($condition,$data);

    }





    //menampilkan data document
    public function read_document_config() 
    {
        $data['document']    = $this->admin_model->get_document()->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

     //cari admin berdasarkan id dokumen
    public function get_document_config($prm) 
    {
        $data['document'] = $this->admin_model->get_document_by_prm($prm)->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

     //edit data dokumen
    public function document_config_edit_proses()
    {
        $condition = array('id_document_config' => $this->input->post('id_document_config'));
        $data = array(
        'type' => $this->input->post('type'),
        'key' => $this->input->post('key'),
        'display_name' => $this->input->post('display_name'),
        'file_url' => $this->input->post('file_url'),
        'mandatory' => $this->input->post('mandatory'),
        'modified_date' => date('Y-m-j H:i:s'),
        // 'modified_by' => $this->session->userdata('username')                
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' Update Data Dokumen',
        'log_type' => 'Update Data '.$this->input->post('display_name'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

        $this->admin_model->insert_log($dataL);
        $this->admin_model->update_documenet_config($condition,$data);

    }

     //untuk menuju form isian data tambah doc
    public function insert_doc() 
    {
        $this->load->view('');
    }

    //tambah admin doc
    public function insert_doc_proses()
    {      
        $data = array(
        'type' => $this->input->post('type'),
        'key' => $this->input->post('key'),
        'display_name' => $this->input->post('display_name'),
        'file_url' => $this->input->post('file_url'),
        'mandatory' => $this->input->post('mandatory'),
        'created_date' => date('Y-m-j H:i:s'),
        // 'created_by' => $this->session->userdata('username')             
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' adding new doc',
        'log_type' => 'added '.$this->input->post('display_name'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

          $this->admin_model->insert_log($dataL);
          $this->admin_model->insert_documenet_config($data);       
    }





    //menampilkan data cms
    public function read_cms() 
    {
        $data['cms'] = $this->admin_model->get_cms()->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    //cari admin berdasarkan id cms
    public function get_cms($prm) 
    {
        $data['cms'] = $this->admin_model->get_cms_by_prm($prm)->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    //edit data cms
    public function cms_edit_proses()
    {
        $condition = array('id_cms' => $this->input->post('id_cms'));
        $data = array(
        'content' => $this->input->post('content'),
        'title' => $this->input->post('title'),
        'url' => $this->input->post('url'),
        'modified_date' => date('Y-m-j H:i:s'),
        // 'modified_by' => $this->session->userdata('username')                
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' Update Data CMS',
        'log_type' => 'Update Data '.$this->input->post('title'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

        $this->admin_model->insert_log($dataL);
        $this->admin_model->update_cms($condition,$data);

    }

    //untuk menuju form isian data tambah cms
    public function insert_cms() 
    {
        $this->load->view('');
    }

    //tambah cms
    public function insert_cms_proses()
    {      
        $data = array(
        'content' => $this->input->post('content'),
        'title' => $this->input->post('title'),
        'url' => $this->input->post('url'),
        'created_date' => date('Y-m-j H:i:s'),
        // 'created_by' => $this->session->userdata('username')             
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' adding new cms',
        'log_type' => 'added '.$this->input->post('title'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

          $this->admin_model->insert_log($dataL);
          $this->admin_model->insert_cms($data);    
    }






    //menampilkan data user
    public function read_user()
    {
        $data['data_user'] = $this->admin_model->get_user()->result();
        // $this->load->view('admin/data_user',$data);
        echo json_encode($data);
    }

    //cari user berdasarkan id 
    public function get_user($prm) 
    {
        $data['data_user'] = $this->admin_model->get_user_by_prm($prm)->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
    }

    //edit data user
    public function user_edit_proses()
    {
        $condition = array('id_user' => $this->input->post('id_user'));
        $data = array(
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'name' => $this->input->post('name'),
        'status_user' => $this->input->post('status_user'),
        'survey_status' => $this->input->post('survey_status'),
        'modified_date' => date('Y-m-j H:i:s')
        // 'modified_by' => $this->session->userdata('username')                
        );
        $dataL = array(
        'detail_log' => $this->session->userdata('admin_role').' Update Data user',
        'log_type' => 'Update Data user '.$this->input->post('name'), 
        'created_date' => date('Y-m-j H:i:s')
        // 'created_by' => $this->session->userdata('username')
        );

        $this->admin_model->insert_log($dataL);
        $this->admin_model->update_user($condition,$data);

    }






    //menampilkan data surve
    public function get_survey()
    {
        $data['survey'] = $this->admin_model->question_survey_question()->result();
        echo json_encode($data);
        // $this->load->view('survey',$data);
    }






    //menampilkan data IIN
    public function get_iin_data()
    {
        $data['iin'] = $this->admin_model->get_iin()->result();
        echo json_encode($data);
    }

    //cari iin berdasarkan id iin
    public function get_iin($prm) 
    {
        $data['iin'] = $this->admin_model->get_iin_by_prm($prm)->result();
        // $this->load->view('admin/data_asesment', $data);
        echo json_encode($data);
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

    //untuk menuju form isian data tambah iiin
    public function insert_iin() 
    {
        $this->load->view('');
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
    }





    //menampilkan user yang komplain
    public function get_complain_data()
    {
        $data['compalin'] = $this->admin_model->get_conplain()->result();
        echo json_encode($data);
    }



}
