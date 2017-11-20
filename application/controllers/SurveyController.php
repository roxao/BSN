<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class SurveyController extends CI_Controller {

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

	public function survey(){
		$survey = $this->admin_model->get_survey_question_active()->result_array();
		
		$data['survey'] = $survey[0]['id_survey_question'];
		$data['data'] = json_decode($survey['0']['question'], true);

		$this->load->view('header');
		$this->load->view('survey',$data);
		$this->load->view('footer');
	}

//tinggal masukkin data ke tabel
	public function insert_question_survey(){
		$count  = explode('|', $this->input->post('number_of_question'))[0];
		$id 	= explode('|', $this->input->post('number_of_question'))[1];

		echo $count . ' - ' . $id;
		return false; 

		$survey_question = array();
		for ($i=1; $i <= $count; $i++) { 
			$type    = $this->input->post('answer'.$i) ? 'RATING': "COMMENT";
			$answer  = $this->input->post('answer'.$i) ? $this->input->post('answer'.$i) : $this->input->post('comment'.$i);
			$answers = array(
                'no'   		=> $i,
                'type'   	=> $type,
                'answer'   	=> $answer
                );
			array_push($survey_question, $answers);
		}

		echo json_encode($survey_question);


	}

}