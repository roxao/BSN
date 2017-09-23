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

    public function insert_log($data)
    {
         $this->db->insert('log', $data);
    }

    public function get_admin()
    {
       return $this->db->get('admin');
    }

    public function insert_admin ($data){
        $this->db->insert('admin', $data);
    }

    public function insert_asesment ($name,$title){
        $this->db->insert('assessment_team', $name);
        $this->db->insert('assessment_team_title', $title);
    }


    // select tabel asesment
    public function get_assessment(){
        return $this->db->get('assessment_team');
    }

    public function get_user(){
        return $this->db->get('user');
    }

    public function get_user_by_prm($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user',$id);
        return $this->db->get();
    }

    public function update_user($condition,$data)
    {
        $this->db->where($condition);
        $this->db->update('user',$data);
    }

    //untuk inbox admin menggunakan get_applications dan get applications2
    public function get_applications(){
        // return $this->db->get('applications');
        $this->db->select('*');
        $this->db->from('application_status');
        $this->db->join ('applications', 'application_status.id_application = applications.id_application');
        $this->db->join('application_status_name','application_status_name.id_application_status_name=application_status.id_application_status_name');
        $this->db->where('iin_status ','1');
        $this->db->where('process_status ','PENDING');
        
        return $this->db->get();
      
    }

    public function get_applications2(){
        // return $this->db->get('applications');
        $this->db->select('*');
        $this->db->from('application_status');
        $this->db->join ('applications', 'application_status.id_application = applications.id_application');
        $this->db->join('application_status_name','application_status_name.id_application_status_name=application_status.id_application_status_name');
        $this->db->where('applications.iin_status','1');
        $this->db->where('application_status.id_application_status_name','2')
                ->or_where('process_status','PENDING');
        
        return $this->db->get();
        
    }


//untuk mengetahui dan mengambil data user dari status ke berapa
    public function get_application($id_application_status){

           
            $this->db->select("*");
            $this->db->from("application_status")
            ->join
             (
                'applications',
                'application_status.id_application = applications.id_application'
             );
            $this->db->where('id_application_status', $id_application_status); 
            return $this->db->get();

    }

    //memilih documen berdasarkan id applications
    public function get_doc_user($id_application)
    {
        $this->db->select("*");
        $this->db->from("application_file");
        $this->db->join("document_config", "document_config.id_document_config=application_file.id_document_config");
        $this->db->where("id_application",$id_application);

        return $this->db->get();
    }

//untuk melanjutkan proses selanjutnya atau dsetujui admin
    public function next_step($data,$condition)
    {
        $this->db->where($condition);
        $this->db->update('application_status',$data);
    }


    public function insert_app_status($data)
    {
       $this->db->insert('application_status', $data);
    }

    public function insert_app_sts_for_map($data)
    {
        $this->db->insert('application_status_form_mapping', $data);
    }

    public function update_app($data,$id_application)
    {
        $this->db->where($id_application);
        $this->db->update('applications',$data);
    }


//untuk mengetahui documen2 yg du ipload user
    public function get_application_file($id_application_status){

           
            $this->db->select("*");
            $this->db->from("application_status");
            $this->db->join(
                'applications',
                'application_status.id_application = applications.id_application'
             );
             $this->db->join(
                'application_file',
                'application_file.id_application=applications.id_application'
             );
             $this->db->join(
                'document_config',
                'document_config.id_document_config=application_file.id_document_config'
             );
            $this->db->where('id_application_status', $id_application_status);
           
            return $this->db->get();

    }

    public function insert_application_file($data)
    {
        $this->db->insert('application_file', $data);
    }

//untuk melihat tabel survey berdasarkan id user sudahkah mengisi atau belum
    public function get_user_survey($user)
    {
         $this->db->select("*");
            $this->db->from("applications")
            ->join
             (
                'user',
                'user.id_user = applications.id_user'
             )
             ->join
             (
                'survey_answer',
                'survey_answer.id_user=user.id_user'
             );
            $this->db->where('id_user', $user); 
            return $this->db->get();
    }

    //untuk mnengecek iin
    public function get_has_iin($user)
    {
        $this->db->select("*");
            $this->db->from("applications")
            ->join
             (
                'user',
                'user.id_user = applications.id_user'
             )
             ->join
             (
                'iin',
                'iin.id_user=user.id_user'
             );
            $this->db->where('id_user', $user); 
            return $this->db->get();
    }


    public function get_applications_tes(){
        // return $this->db->get('applications');
        $this->db->select('*');
        $this->db->from('application_status');
        $this->db->join ('applications', 'application_status.id_application = applications.id_application');
        $this->db->join('application_status_name','application_status_name.id_application_status_name=application_status.id_application_status_name');
        $this->db->where('process_status','PENDING');
        $this->db->where('applications.iin_status','1');
        
        return $this->db->get();
        // return $query->result();
    }

    

    public function insert_assesment_application($data)
    {
         $this->db->insert('assesment_application', $data);
    }

    public function get_assesment_application($id)
    {
        $this->db->select('*');
        $this->db->from('application_status');
        $this->db->where('id_application', $id);
        $this->db->where('assessment_status', 'OPEN');
        return $this->db->get();
    }

    public function insert_assessment_registered($data)
    {
         $this->db->insert('assessment_registered', $data);
    }

    public function insert_assessment_application($data)
    {
        $this->db->insert('assessment_application', $data);
    }

    public function get_assessment_team($data)
    {
        $this->db->select('*');
        $this->db->from('assessment_team');
        $this->db->like('name', $data);
        return $this->db->get();
    }

    public function get_assessment_team_title()
    {
         return $this->db->get('assessment_team_title');
    }

    public function get_pay_user()
    {

    }

    public function get_document()
    {
        return $this->db->get('document_config');
    }

    public function get_document_by_prm($id)
    {

        $this->db->select('*');
        $this->db->from('document_config');
        $this->db->where('id_document_config',$id);
        return $this->db->get();
    }

    public function update_documenet_config($condition,$data)
    {
        $this->db->where($condition);
        $this->db->update('document_config',$data);
    }

    public function question_survey_question()
    {
        return $this->db->get('survey_question');
    }

    public function question_survey_question_by_prm($id)
    {
        $this->db->select('*');
        $this->db->from('survey_question');
        $this->db->where('id_survey_question',$id);
        return $this->db->get();
    }

    public function update_survey_question($condition,$data)
    {
        $this->db->where($condition);
        $this->db->update('survey_question',$data);
    }

    public function insert_survey_question($data)
    {
        $this->db->insert('survey_question', $data);
    }


    public function get_iin()
    {
       return $this->db->get('iin');
    }

    public function get_iin_by_prm($id)
    {
        $this->db->select('*');
        $this->db->from('iin');
        $this->db->where('id_iin',$id);
        return $this->db->get();
    }

    public function update_iin($condition,$data)
    {
        $this->db->where($condition);
        $this->db->update('iin',$data);
    }

    public function get_cms()
    {
       return $this ->db-> get('cms');
    }

    public function get_cms_by_prm($id)
    {
        $this->db->select('*');
        $this->db->from('cms');
        $this->db->where('id_cms',$id);
        return $this->db->get();
    }

    public function update_cms($condition,$data)
    {
        $this->db->where($condition);
        $this->db->update('cms',$data);
    }

    public function get_conplain()
    {
        return $this->db->get('complaint');
    }

    public function insert_document_config($data)
    {
        $this->db->insert('document_config', $data);
    }

    //untuk laporan cetak laporan smentara lihat ini dulu
    public function get_application_data($data)
    {
        $this->db->get('applications');
    }

    //untuk select email user
    public function get_user_application_data($data)
    {
        
        $this->db->select('*');
        $this->db->from('applications');
        $this->db->where('id_application',$data);
        return $this->db->get();

    }
}
?>
