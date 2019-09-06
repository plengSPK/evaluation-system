<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
    }
     
	public function index()
	{		
        if($this->session->login != 'true'){
            redirect('/');
		}
		
		$data['subtitle'] = 'Dashboard';

		$user_detail = $this->session->user_detail;
		$data['user_detail'] = $user_detail;
		$data_detail['user_detail'] = $user_detail;
        
		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data_detail);
		$this->load->view('templates/footer');
	}
}
