<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
		$this->load->model('evaluate_model');
		$this->load->model('request_model');
    }
     
	public function index()
	{		
        if($this->session->login != 'true'){
            redirect('/');
		}
		
		$data['subtitle'] = 'Dashboard';

		$user_detail = $this->session->user_detail;
		$data['user_detail'] = $user_detail;

		$temp_date = array('month' => '2','year' => '2019');
		[$curQuarter,$curYear] = getQuarterYear();
		$val_date = array('quarter' => $curQuarter, 'year' => $curYear);
		$data_index['val_date'] = $val_date;
		//echo $curQuarter. "/" . $curYear;

		$department_name = $this->department_model->getDepartment_by_id($user_detail['department_id']);
		$data_index['department_name'] = $department_name[0]['department_name'];

		if($user_detail['level'] == '1'){			
			$val_user = $this->user_model->getAllEmp_by_department($user_detail['department_id'], $user_detail['user_id']);
			$val_eval = $this->evaluate_model->getEvaluation_by_emp($user_detail['department_id'], $user_detail['user_id'], $curQuarter, $curYear);
			
			if($val_eval != false)
				$precent_complete = number_format((float)count($val_eval)*100/count($val_user), 2, '.', '');
			else
				$precent_complete = 0;

			$data_index['precent_complete'] = $precent_complete;
			$data_index['val_user'] = $val_user;
			$data_index['val_eval'] = $val_eval;
	
			$this->load->view('templates/header', $data);
			$this->load->view('dashboard/dashboard_employee', $data_index);
			$this->load->view('templates/footer');
			
		}elseif($user_detail['level'] == '2'){
			$val_user = $this->user_model->getAllEmp_by_department($user_detail['department_id']);
			$val_eval = $this->evaluate_model->getAllEvaluation($user_detail['department_id'], $curQuarter, $curYear);
				// echo "<pre>" . print_r($val_user) . "<pre>" . "<br>";
				// echo "<pre>" . print_r($val_eval) . "<pre>" . "<br>";
			// $val_temp = array_count_values(array_column($val_eval, 'target_user_id'));
			// echo "<pre>" . print_r($val_temp) . "<pre>" . "<br>";

			// foreach($val_user as $index => $user){
			// 	$countEval = $val_temp[$user['user_id']];
			// 	echo $user['name'] . ": " . $countEval . "<br>";
			// }

			// foreach($val_user as $index => $user){
			// 	$request_id = $this->request_model->checkNewRequest($user['user_id'], $user_detail['user_id'],$user_detail['department_id']);
			// 	if($request_id != false){            
			// 		$val_user[$index]['request_id'] = $request_id[0]['request_id'];
			// 		$val_user[$index]['status'] = $request_id[0]['status'];					
			// 	}else{
			// 		$val_user[$index]['request_id'] = false;
			// 	}
			// }
			$val_req = $this->request_model->getAllRequest_by_Byuser($user_detail['user_id']);

			$data_index['val_user'] = $val_user;
			$data_index['val_eval'] = $val_eval;
			$data_index['val_req'] = $val_req;

			$this->load->view('templates/header', $data);
			$this->load->view('dashboard/dashboard_manager', $data_index);
			$this->load->view('templates/footer');

		}elseif($user_detail['level'] == '3'){
			$val_user = $this->user_model->getAllEmp_by_department($user_detail['department_id']);
			$val_eval = $this->evaluate_model->getAllEvaluation($user_detail['department_id'], $curQuarter, $curYear);

			$val_req = $this->request_model->getAllRequest($user_detail['department_id']);

			$data_index['val_user'] = $val_user;
			$data_index['val_eval'] = $val_eval;
			$data_index['val_req'] = $val_req;
	
			$this->load->view('templates/header', $data);
			$this->load->view('dashboard/dashboard_director', $data_index);
			$this->load->view('templates/footer');
		}
	}

}
