<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testcase extends  CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->library('unit_test');
    }

    public function testcase1()
    {
        $user_1 = $this->user_model->getUserInfo_by_id(1);
        $test = $user_1[0]['department_id'];
        $expected_result = 4;
        $test_name = "Get user's department_id by user_id = 1";
        
        $this->unit->run($test, $expected_result, $test_name);

        echo $this->unit->report();
    }
    
    public function testcase2()
    {
        $date = array('date' => 12,'month' => 7,'year' => 2019);
        $test = checkEvaluateDate($date);
        $expected_result = true;
        $test_name = "Check is date in evaluation session?";
        
        $this->unit->run($test, $expected_result, $test_name);

        echo $this->unit->report();
    }

    public function testcase3()
    {
        $department_4 = $this->department_model->getDepartment_by_id(4);
        $test = $department_4[0]['department_name'];
        $expected_result = 'Developer';
        $test_name = "Get department's name by id = 4";

        $this->unit->run($test, $expected_result, $test_name);

        echo $this->unit->report();
    }
}
