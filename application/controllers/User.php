<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->library('form_validation');
    }
     
    public function index()
    {
        if($this->session->login == 'true'){
            redirect('/dashboard');
        }

        $data['subtitle'] = 'Login';
    
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == TRUE) {
            $response_val = $this->user_model->loginUser($email, $password);
            if ($response_val == true) {
                $val = $this->user_model->getUserInfo($email);
                $this->session->set_userdata('user_detail', $val[0]);
                $this->session->set_userdata('login', 'true');
                redirect('/');
            }else{
                $this->session->set_flashdata('login_info', 'Invalid Email or Password');
            }
        }
        
		$this->load->view('templates/header', $data);
		$this->load->view('user/login');
		$this->load->view('templates/footer');
    }

    public function register()
    {
        $data['subtitle'] = 'Register';

        $departments = $this->department_model->getAllDepartment();
        $data_select = array('departments' => $departments);
        //echo "<pre>" . print_r($departments) . "</pre>";

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $name = $this->input->post('name');
        $department = $this->input->post('department');
        $level = $this->input->post('level');

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('department', 'department', 'required');
        $this->form_validation->set_rules('level', 'level', 'required');
       
        if ($this->form_validation->run() == TRUE) {
            $response_val = $this->user_model->insertUser($name, $email, $password, $department, $level);
            if ($response_val == true) {
                $this->session->set_flashdata('register_info', 'Register Successful!');
            }
            redirect('/');
        }
        
		$this->load->view('templates/header', $data);
		$this->load->view('user/register', $data_select);
        $this->load->view('templates/footer');

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
