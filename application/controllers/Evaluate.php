<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluate extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->model('evaluate_model');
        $this->load->library('form_validation');
    }

    public function index()
	{		
        redirect('/dashboard');
    }

	public function new($target_id = 0)
	{		
        if($target_id == 0){
            $this->index();
        }

        $data['subtitle'] = 'Evaluate';
		$user_detail = $this->session->user_detail;
		$data['user_detail'] = $user_detail;

        $val = $this->user_model->getUserInfo_by_id($target_id);
        $data_detail['target_user'] = $val[0];

        $score_time = $this->input->post('score_time');
        $score_quality = $this->input->post('score_quality');
        $score_creativity = $this->input->post('score_creativity');
        $score_teamwork = $this->input->post('score_teamwork');
        $score_discipline = $this->input->post('score_discipline');

        $this->form_validation->set_rules('score_time', 'Time management', 'required');
        $this->form_validation->set_rules('score_quality', 'Quality of work', 'required');
        $this->form_validation->set_rules('score_creativity', 'Creativity', 'required');
        $this->form_validation->set_rules('score_teamwork', 'Team work', 'required');
        $this->form_validation->set_rules('score_discipline', 'Discipline', 'required');
        
        [$curQuarter,$curYear] = getQuarterYear();
        
        if ($this->form_validation->run() == TRUE) {
            if($user_detail['user_id'] != $target_id){
                $data_insert = array(
                    'time_mange_score' => $score_time,
                    'quality_score' => $score_quality,
                    'creativity_score' => $score_creativity,
                    'teamwork_score' => $score_teamwork,
                    'discipline_score' => $score_discipline,
                    'target_user_id' => $target_id,
                    'evaluator_user_id' => $user_detail['user_id'],
                    'department_id' => $user_detail['department_id'],
                    'quarter' => $curQuarter,
                    'year' => $curYear,
                    'last_update' => date('Y-m-d')
                );
    
                $response_val = $this->evaluate_model->InsertNewRecord($data_insert);
                if ($response_val == true) {
                    $this->session->set_flashdata('evaluate_info', 'Evaluate Successful!');
                    redirect('/dashboard');
                }
            }else{
                $this->session->set_flashdata('evaluate_info_sameID', 'Cannot Evaluation!');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('evaluate/index',$data_detail);
        $this->load->view('templates/footer');
        
    }


    public function view($evalaute_id = 0)
	{		
        if($evalaute_id == 0){
            $this->index();
        }

        $data['subtitle'] = 'Evaluate';
        $user_detail = $this->session->user_detail;
        $data['user_detail'] = $user_detail;        

        $val_eval = $this->evaluate_model->getEvaluation_by_id($evalaute_id);
        $data_detail['evalaute_detail'] = $val_eval[0];

        $val_target = $this->user_model->getUserInfo_by_id($val_eval[0]['target_user_id']);
        $data_detail['target_user'] = $val_target[0];

        $this->load->view('templates/header', $data);
        $this->load->view('evaluate/view', $data_detail);
        $this->load->view('templates/footer');
        
    }

    public function result($user_id = 0, $year = 0, $quarter = 0)
	{		
        if($user_id == 0){
            $this->index();
        }

        $data['subtitle'] = 'Evaluate';
		$user_detail = $this->session->user_detail;
		$data['user_detail'] = $user_detail;
		$data_detail['user_detail'] = $user_detail;
        
        $this->load->view('templates/header', $data);
		$this->load->view('evaluate/result',$data_detail);
		$this->load->view('templates/footer');
    }
}