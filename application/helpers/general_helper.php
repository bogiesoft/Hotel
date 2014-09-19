<?php

function languages(){
	$langs = array(
		'1' => array('name' => 'English', 'code' => 'en'),
		'2' => array('name' => 'Türkçe', 'code' => 'tr'),
		'3' => array('name' => 'Deutsch', 'code' => 'de'));

	return $langs;
	
}

/*
* For header
*/
function get_hotels(){
	$CI =& get_instance();

	$code = $CI->session->userdata('code');

	$hotels = $CI->db->query("SELECT id,name FROM hotels where code ='$code'");

	return $hotels->result();
}

/*
* For specs. Changes the value of spec to array key
*/
function arr_val_to_key($arr){
	$new = array();
	foreach ($arr as $key => $value) {
		$new[$value] = $value;
	}
	return $new;
}


function days_checkbox($id=''){
	$days = array(
		'Sun'	=> 'Sunday',
		'Mon' 	=> 'Monday',
		'Tue' 	=> 'Tuesday',
		'Wed' 	=> 'Wednesday',
		'Thu' 	=> 'Thursday',
		'Fri' 	=> 'Friday',
		'Sat'	=> 'Saturday');

	if ($id > 0) {
		return $days[$id];
	}else{
		return $days;
	}
}

function date_range($strDateFrom,$strDateTo) {
  // takes two dates formatted as YYYY-MM-DD and creates an
  // inclusive array of the dates between the from and to dates.

  // could test validity of dates here but I'm already doing
  // that in the main script

  $aryRange=array();

  $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
  $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

  if ($iDateTo>=$iDateFrom) {
    array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry

    while ($iDateFrom<$iDateTo) {
      $iDateFrom+=86400; // add 24 hours
      array_push($aryRange,date('Y-m-d',$iDateFrom));
    }
  }
  return $aryRange;
}