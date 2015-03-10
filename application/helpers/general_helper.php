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
		'Sun'	=> lang('sunday'),
		'Mon' 	=> lang('monday'),
		'Tue' 	=> lang('tuesday'),
		'Wed' 	=> lang('wednesday'),
		'Thu' 	=> lang('thursday'),
		'Fri' 	=> lang('friday'),
		'Sat'	=> lang('saturday'));

	if ($id != '') {
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

function promotion_available($date,$pid,$room_id){
	$ci =& get_instance();

	$query = $ci->db->query("SELECT available,stoped FROM price_plans_availability WHERE room_id = '$room_id' and price_plan_id = '$pid' and price_date='$date'")->row_array();

	if ($query) {
		return $query;
	}else{
		return false;
	}

}


/*
* List room children age rules by room
*/
function room_children($room_id){
	$ci =& get_instance();
	$ci->load->model('reservation_model');
	return $ci->reservation_model->room_children($room_id);
}


function convert($from, $to, $retry = 0)
{
    $ch = curl_init("http://download.finance.yahoo.com/d/quotes.csv?s=$from$to=X&f=l1&e=.csv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    $rate = curl_exec($ch);
    curl_close($ch);
    if ($rate) {
        return (float)$rate;
    } elseif ($retry > 0) {
        return convert($from, $to, --$retry);
    }
    return false;
}


/*
* Get curency rates
*/
function currency_rates($cur,$cur2){
	// get current exchange rates
	$ci =& get_instance();
	$ci->load->driver('cache',array('apdapter'=>'file','backup'=>'file'));
	$file = 'currency-rates-'.$cur;
	if (!$cache = $ci->cache->get($file)) {
			$exurl = 'http://api.fixer.io/latest?base='.$cur;
			$ch = curl_init($exurl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$json_response_content = curl_exec($ch);
			curl_close($ch);
			$cache = $json_response_content;
	 		$ci->cache->file->save('currency-rates-'.$cur, $json_response_content, 5000);
	 		
	 	}

	$data = json_decode($cache,true);
 	return $data['rates'][$cur2];
	
}

function show_price($price,$rate=1){

	return number_format($price*$rate, 2, '.', '');

}

/* DEPRECATED */
function show_price2($price,$cur,$cur2){

	if ($cur != $cur2) {
		$rate = currency_rates($cur,$cur2);
		return number_format($price*$rate, 2, '.', '');
	}
	return number_format($price, 2, '.', '');

}



function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}