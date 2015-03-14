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

/*
*	Eğer adult 3 ise ve price 2 kişilik ayarlanmışsa 3.kişi için son ayarlanan fiyat geçerli
*/
function calculate_extra_price($obj,$person){
	$price = '';
	//print_r($obj);
	end($obj);
	// get the key
	$key = key($obj);
	for ($i=1; $i <=$person ; $i++) {
		if (isset($obj->$i)) {
			$price += $obj->$i;
		}else{
			$price += $obj->$key;
		}

	}

	return $price;
}

/*
* Teting the formbuilder library
*/

function formbuild($form){
	if ($form != NULL) {
		$ci =& get_instance();
		$ci->load->library('Formbuilder');
		$ci->formbuilder->setFormbuilderSchema(json_decode($form));
	    print_r( $ci->formbuilder->toJsonFormFromSchema());
	}else{
		echo 'Form Yok';
	}

}

function form_builder($json,$arr=array()){

	$option['id'] 		= isset($arr['id']) ? $arr['id'] : 0;
	$option['name'] 	= isset($arr['name']) ? $arr['name'] : 'default[]';
	$option['class'] 	= isset($arr['class']) ? 'class="'.$arr['class'].'"' : 'class="form"';

	//start form fields
	$output = '';
	$json = json_decode($json);
	if (is_array($json)) {
		
		foreach ($json as $key => $form) {
			
			//if field = text
			if($form->field_type == 'text'){
				$output .= '<label>'.$form->label.'</label>';
				$output .= '<input type="text" name="'.$option['name'].'['.$form->label.']" '.$option['class'].'>';
			}

			//if field = paragraph
			if($form->field_type == 'paragraph'){
				$output .= '<label>'.$form->label.'</label>';
				$output .= '<textarea name="'.$option['name'].'['.$form->label.']" '.$option['class'].'></textarea>';
			}


			//if field = time
			if($form->field_type == 'time'){
				$output .= '<label>'.$form->label.'</label>';
				$output .= '<input type="text" name="'.$option['name'].'['.$form->label.'][hh]" '.$option['class'].' style="width:30px">';
				$output .= '<input type="text" name="'.$option['name'].'['.$form->label.'][mm]" '.$option['class'].' style="width:30px">';
				$output .= '<input type="text" name="'.$option['name'].'['.$form->label.'][ss]" '.$option['class'].' style="width:30px">';
			}


			//if field = date
			if ($form->field_type == 'date') {
				$class = substr_replace($option['class'], ' datepicker"', -1);
				$output .= '<label>'.$form->label.'</label>';
				$output .= '<input type="text" name="'.$option['name'].'['.$form->label.']" '.$class.'>';

			}


			//if field = checkbox
			if ($form->field_type == 'checkboxes') {
				$output .= '<label>'.$form->label.'</label>';

				foreach ($form->field_options->options as $opt => $checkbox) {
					$checked = $checkbox->checked === true ? 'checked="checked"' : '';
					$output .= '<input type="checkbox" name="'.$option['name'].'['.$form->label.']" '.$option['class'].' '.$checked.'>';
					$output .= '<label>'.$checkbox->label.'</label>';
				}
				if (isset($form->field_options->include_other_option) and $form->field_options->include_other_option == 1) {
					$output .= '<input type="text" name="'.$option['name'].'['.$form->label.']" '.$option['class'].'>';
					$output .= '<label>Other</label>';			
				}

			}

			//if field = radio
			if ($form->field_type == 'radio') {
				$output .= '<label>'.$form->label.'</label>';

				foreach ($form->field_options->options as $opt => $checkbox) {
					$checked = $checkbox->checked === true ? 'checked="checked"' : '';
					$output .= '<input type="radio" name="'.$option['name'].'['.$form->label.']" '.$option['class'].' '.$checked.'>';
					$output .= '<label>'.$checkbox->label.'</label>';
				}
				if (isset($form->field_options->include_other_option) and $form->field_options->include_other_option == 1) {
					$output .= '<input type="text" name="'.$option['name'].'['.$form->label.']" '.$option['class'].'>';
					$output .= '<label>Other</label>';			
				}

			}


			//if field = dropdown
			if ($form->field_type == 'dropdown') {
				$output .= '<label>'.$form->label.'</label>';
				$output .= '<select name="'.$option['name'].'['.$form->label.']" '.$option['class'].'>';
				foreach ($form->field_options->options as $opt => $checkbox) {
					$selected = $checkbox->checked === true ? 'checked="checked"' : '';
					$output .= '<option value="'.$checkbox->label.'" '.$selected.'>'.$checkbox->label.'</option>';
				}
				$output .= '</select>';

			}

			$output .= '<br>';


		}

		return $output;
	}else{

		return false;
	}

	

}