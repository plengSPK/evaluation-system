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