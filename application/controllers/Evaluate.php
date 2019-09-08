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
            if($user_detail['user_id'] != $target_id && $user_detail['level'] == '1'){
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
        
        $this->form_validation->set_rules('quarter', 'Quarter', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required');
        $this->form_validation->run();
        if ($this->form_validation->run() == TRUE) {
            $quarter = $this->input->post('quarter');
            $year = $this->input->post('year');
        }

        $data['subtitle'] = 'Evaluate';
		$user_detail = $this->session->user_detail;
		$data['user_detail'] = $user_detail;
        $data_detail['user_detail'] = $user_detail;

        $val_target = $this->user_model->getUserInfo_by_id($user_id);
        $data_detail['target_user'] = $val_target[0];

        if($user_detail['level'] == '1'){
            if($user_id != $user_detail['user_id']){
                $this->index();
            }
        }elseif($user_detail['level'] == '2'){
            if($val_target[0]['department_id'] != $user_detail['department_id']){
                $this->index();
            }
        }
        
        if($year == 0){
            [$curQuarter,$curYear] = getQuarterYear();
            $val_eval = $this->evaluate_model->getEvaluation_by_targetUser($user_id,$curQuarter,$curYear);
            $data_detail['quarter'] = $curQuarter;
            $data_detail['year'] = $curYear;
        }else{
            $val_eval = $this->evaluate_model->getEvaluation_by_targetUser($user_id,$quarter,$year);
            $data_detail['quarter'] = $quarter;
            $data_detail['year'] = $year;
        }
        
        if( $val_eval == ''){           
            $data_detail['no_data'] = 'true';

            $this->load->view('templates/header', $data);
            $this->load->view('evaluate/result',$data_detail);
            $this->load->view('templates/footer');
        }else{
            $data_detail['val_eval'] = $val_eval;
            $count_eval = count($val_eval);

            $val_user = $this->user_model->coountAllEmp_by_department($user_detail['department_id']);
            $count_emp = $val_user[0]['count']-1;
            $data_detail['count_emp'] = $count_emp;
    
            if($count_eval != $count_emp){
                $data_detail['isNotComplete'] = 'true';
            }

            $sum_score = array();
            $score = array('time_mange_score','quality_score','creativity_score','teamwork_score','discipline_score');
            foreach($score as $item){
                $average_score = array_sum(array_column($val_eval, $item))/$count_emp;
                //$sum_score[$item] = $average_score; 
                //$sum_score[$item] = number_format((float)$average_score, 2, '.', ''); 
                $sum_score[$item] = number_format((float)$average_score*100/4,2, '.', ''); 
            }
            $data_detail['sum_score'] = $sum_score;
            //echo "<pre>" . print_r($final) . "<pre>" . "<br>";
            
            $this->load->view('templates/header', $data);
            $this->load->view('evaluate/result',$data_detail);
            $this->load->view('templates/footer');
        }
    }

}