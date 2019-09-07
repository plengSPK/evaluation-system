<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('getQuarterYear'))
{
    function getQuarterYear($date = 0){

		if($date == 0){
			$curMonth = date("m", time());
			$curYear = date("Y");
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