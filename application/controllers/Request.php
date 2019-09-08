<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->model('evaluate_model');
        $this->load->model('request_model');
        $this->load->model('approve_model');
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

        //check if already have request record or not => new/view page
        $data['subtitle'] = 'Request';
		$user_detail = $this->session->user_detail;
        $data['user_detail'] = $user_detail;
        
        // $request_id = $this->request_model->checkNewRequest($target_id, $user_detail['user_id'],$user_detail['department_id']);
        // if($request_id != false){            
        //     redirect('/request/view/' . $request_id[0]['request_id']);
        // }

        $target_user = $this->user_model->getUserInfo_by_id($target_id);
        $data_detail['target_user'] = $target_user[0];

        $val_user = $this->user_model->coountAllEmp_by_department($user_detail['department_id']);
        $count_emp = $val_user[0]['count']-1;
        $data_detail['count_emp'] = $count_emp;
        
        $new_salary = $this->input->post('new_salary');
        $comment = $this->input->post('comment');

        $this->form_validation->set_rules('new_salary', 'Pending Salary', 'required');
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        
        if ($this->form_validation->run() == TRUE) {
            if($user_detail['level'] == '2' && $user_detail['department_id'] == $target_user[0]['department_id']){
                $data_insert = array(
                    'detail' => $comment,
                    'salary_target' => $new_salary,
                    'target_user_id' => $target_id,
                    'by_user_id' => $user_detail['user_id'],
                    'department_id' => $user_detail['department_id'],
                    'status' => '0',
                    'last_update' => date('Y-m-d')
                );
    
                $response_val = $this->request_model->InsertNewRequest($data_insert);
                if ($response_val == true) {
                    $this->session->set_flashdata('request_info', 'Pending Request Successful!');
                    redirect('/dashboard');
                }
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('request/index',$data_detail);
        $this->load->view('templates/footer');
        
    }

    public function view($request_id = 0)
	{		
        if($request_id == 0){
            $this->index();
        }

        $data['subtitle'] = 'Evaluate';
        $user_detail = $this->session->user_detail;
        $data['user_detail'] = $user_detail;        

        $val_user = $this->user_model->coountAllEmp_by_department($user_detail['department_id']);
        $count_emp = $val_user[0]['count']-1;
        $data_detail['count_emp'] = $count_emp;

        $val_req = $this->request_model->getRequest_by_id($request_id);
        $data_detail['request_detail'] = $val_req[0];

        $val_target = $this->user_model->getUserInfo_by_id($val_req[0]['target_user_id']);
        $data_detail['target_user'] = $val_target[0];

        $this->load->view('templates/header', $data);
        $this->load->view('request/index', $data_detail);
        $this->load->view('templates/footer');
        
    }

    public function detail($request_id = 0){
        if($request_id == 0){
            $this->index();
        }
        
        $data['subtitle'] = 'Evaluate';
        $user_detail = $this->session->user_detail;
        $data['user_detail'] = $user_detail;        

        $val_req = $this->request_model->getRequest_by_id($request_id);
        $data_detail['request_detail'] = $val_req[0];

        $val_target = $this->user_model->getUserInfo_by_id($val_req[0]['target_user_id']);
        $data_detail['target_user'] = $val_target[0];

        $val_approve = $this->approve_model->GetApprove($request_id);
        $data_detail['val_approve'] = $val_approve[0];

        if($user_detail['level'] == 1 || ($user_detail['department_id'] != $val_req[0]['department_id'])){
            $this->index();
        }
        
        $formSubmit = $this->input->post('submit-btn');
        if( $formSubmit == 'reject' ){

            $reason = $this->input->post('reason');
            $this->form_validation->set_rules('reason', 'Reason', 'required');     

            if ($this->form_validation->run() == TRUE) {
                $status = 2;
                $response_val = $this->request_model->UpdateStatus($request_id, $status);

                $data_insert = array(
                    'approve_user_id' => $user_detail['user_id'],
                    'reason' => $reason,
                    'request_id' => $request_id,
                    'last_update' => date('Y-m-d')
                );
                $approve_val = $this->approve_model->InsertNewApprove($data_insert);

                if ($response_val == true && $approve_val == true) {
                    $this->session->set_flashdata('approve_info', 'Successful!');
                    redirect('/dashboard');
                }
            }
        } elseif( $formSubmit == 'approve' ){
            $status = 1;
            $response_val = $this->request_model->UpdateStatus($request_id, $status);

            $data_insert = array(
                'approve_user_id' => $user_detail['user_id'],
                'request_id' => $request_id,
                'last_update' => date('Y-m-d')
            );
            $approve_val = $this->approve_model->InsertNewApprove($data_insert);

            if ($response_val == true && $approve_val == true) {
                $this->session->set_flashdata('approve_info', 'Successful!');
                redirect('/dashboard');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('request/detail', $data_detail);
        $this->load->view('templates/footer');
    }

    public function post_data(){
        $target_id = $this->input->post('target_id');
        $val = $this->evaluate_model->getAllEvaluation_allTime($target_id);
        //echo "<pre>" . print_r($val) . "<pre>" . "<br>";
        echo json_encode($val);
    }

}