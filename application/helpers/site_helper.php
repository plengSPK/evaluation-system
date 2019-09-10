<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('getQuarterYear'))
{
    function getQuarterYear($date = 0){

		if($date == 0){
			// $curMonth = date("m", time());
			// $curYear = date("Y");
			$curMonth = $GLOBALS['date']['month'];
			$curYear = $GLOBALS['date']['year'];
		}else{			
			$curMonth = $date['month'];
			$curYear = $date['year'];
		}
		$curQuarter = ceil($curMonth/3);

		return [$curQuarter,$curYear];
	}
}

if(!function_exists('convertScore'))
{
    function convertScore($score){

		switch($score){
			case 4:
				return "Very Good";
				break;			
			case 3:
				return "Good";
				break;				
			case 2:
				return "So So";
				break;				
			case 1:
				return "Bad";
				break;
				
		}
	}
}

if(!function_exists('checkEvaluateDate'))
{
    function checkEvaluateDate($date){
		$evaluate_date = 14;
		$evaluate_month = array(1,4,7,10);

		if($date['date'] <= $evaluate_date && in_array($date['month'],$evaluate_month)){
			return true;
		}else{
			return false;
		}
	}
}


if(!function_exists('getDueDateQuarter'))
{
	function getDueDateQuarter($quarter,$year){
		$duedate = '1 - 14';

		// [$quarter,$year] = getPreviousQuarter($quarter,$year);

		switch($quarter){
			case 1:
				return $duedate . ' April ' . $year;
				break;			
			case 2:
				return $duedate . ' July ' . $year;
				break;				
			case 3:
				return $duedate . ' October ' . $year;
				break;				
			case 4:
				$year += 1;
				return $duedate . ' January ' . (int)$year;
				break;
				
		}
	}
}



if(!function_exists('getPreviousQuarter'))
{
	function getPreviousQuarter($quarter,$year){

		switch ($quarter) {
			case 1:
				$quarter = 4;
				$year -= 1;
				break;
			default:
				$quarter -= 1;
				break;
		}

		return [$quarter,$year];
	}
}