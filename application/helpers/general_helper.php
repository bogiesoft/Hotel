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