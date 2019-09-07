<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
		$this->load->model('evaluate_model');
    }
     
	public function index()
	{		
        if($this->session->login != 'true'){
            redirect('/');
		}
		
		$data['subtitle'] = 'Dashboard';

		$user_detail = $this->session->user_detail;
		$data['user_detail'] = $user_detail;

		$temp_date = array('month' => '2','year' => '2016');
		[$curQuarter,$curYear] = getQuarterYear();
		//echo $curQuarter. "/" . $curYear;

		$val_user = $this->user_model->getAllEmp_by_department($user_detail['department_id'], $user_detail['user_id']);
		$val_eval = $this->evaluate_model->getEvaluation_by_emp($user_detail['department_id'], $user_detail['user_id'], $curQuarter, $curYear);
		// echo print_r($val_eval);

		// foreach($val_user as $user){
		// 	$isEval = array_search($user['user_id'], array_column($val_eval, 'target_user_id')); //  !== false ? true : false
		// 	echo $isEval;
		// 	echo $val_eval[$isEval]['evaluate_id'];
		// }

		$data_index['val_user'] = $val_user;
		$data_index['val_eval'] = $val_eval;

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard/index', $data_index);
		$this->load->view('templates/footer');
	}

	// private function getQuarterYear($date = 0){

	// 	if($date == 0){
	// 		$curMonth = date("m", time());
	// 		$curYear = date("Y");
	// 	}else{			
	// 		$curMonth = $date['month'];
	// 		$curYear = $date['year'];
	// 	}
	// 	$curQuarter = ceil($curMonth/3);

	// 	return [$curQuarter,$curYear];
	// }
}
