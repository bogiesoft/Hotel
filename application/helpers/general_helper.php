<?php
/*
* Get current url with query string
*/
function current_full_url()
{
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    $string  = $_SERVER['QUERY_STRING'];
    if ($CI->input->get('cur')) {
    	 $string = substr($string,0,-8);
    }
    return  $string ? $url.'?'. $string : $url;
}

/*
* Replace form chars 
* Resolve for codeigniter Disallowed Chars.
*/
function replace_chars($text){
	$search  = array('?', '-', '#', '!', '%','&','^',' ');
    $replace = array('', '', '', '', '', '', '','_');

    $form = str_replace($search, $replace, $text);

	$a  = array('ı', 'ş', 'ç','ö', 'ü', 'ğ','İ','Ğ','Ş','Ç','Ö','Ü');
    $b = array('i', 's', 'c','o', 'ü', 'g','I','G','S','C','O','U');

    return str_replace($a, $b, $form);
}


function languages(){
	$langs = array(
		'1' => array('name' => 'English', 'code' => 'en'),
		'2' => array('name' => 'Türkçe', 'code' => 'tr'),
		'3' => array('name' => 'Deutsch', 'code' => 'de'),
		'4' => array('name' => 'Italian', 'code' => 'it'),
		);

	return $langs;
	
}

function credit_cards(){
	$cards = array(
		'1' => array('name' => 'MasterCard', 'class' => 'master'),
		'2' => array('name' => 'Visa', 'class' => 'visa'),
		'3' => array('name' => 'Maestro', 'class' => 'maestro'),
		'4' => array('name' => 'Discover', 'class' => 'discover'),
		'5' => array('name' => 'Club', 'class' => 'club'),
		);

	return $cards;
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


/*
* Checks if promotion availablity and stoped
* @USED IN : views/reservation/prices.php
* @USED IN : controllers/hotel.php
*/
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
* @USED IN : views/reservation/prices_add.php
*/
function room_children($room_id){
	$ci =& get_instance();
	$ci->load->model('reservation_model');
	return $ci->reservation_model->room_children($room_id);
}


/*
* DEPRECATED
*/
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
* DEPRECATED
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


/*
* Form Render
*
* TO DO : Bootstrap row yapısına geçirilecek
* 		  Böyle çok salak bi html üretiyor.
*/

function form_builder($json,$arr=array()){

	$option['id'] 			= isset($arr['id']) ? $arr['id'] : 0;
	$option['name'] 		= isset($arr['name']) ? $arr['name'] : 'extra';
	$option['price'] 		= isset($arr['price']) ? $arr['price'] : '00';
	$option['class'] 		= isset($arr['class']) ? 'class="'.$arr['class'].'"' : 'class="form"';
	$option['extra_name']	= isset($arr['extra_name']) ? $arr['extra_name'] : '';
	$option['currency']		= isset($arr['currency']) ? $arr['currency'] : 'EUR';
	$option['user_currency']= isset($arr['user_currency']) ? $arr['user_currency'] : 'EUR';
	$option['currency_rate']= isset($arr['currency_rate']) ? $arr['currency_rate'] : '1';
	$option['button']		= isset($arr['button']) ? $arr['button'] : true;

	//start form fields
	$output = '';
	$json = json_decode($json);
	if (is_array($json) and count($json) > 0) {

		$output .= '<div class="'.$option['name'].'-form '.$option['name'].'_form'.$option['id'].'">';

		//eğer preferecences ise forma guest name surname ekle
		if($option['name'] == 'pref'){
			$output .= '<div class="f-row">
		    <span class="frm-label">
		    Full Guest Name:<span class="c-f00">*</span>
		    </span>';
			$output .= '<span class="frm-val">
			<input type="text" name="'.$option['name'].'['.$option['id'].'][guest_name]" '.$option['class'].' value="Guest Name">
			</span>
			</div>
			';
			
			//$output .= '<br />';
		}


		foreach ($json as $key => $form) {
			
			//if field = text
			if(@$form->field_type == 'text'){
				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';
				$output .= '<span class="frm-val">
				<input type="text" name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).']" '.$option['class'].'>
				</span>
				</div>
				';
			}

			//if field = paragraph
			if(@$form->field_type == 'paragraph'){
				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';
				$output .= '<span class="frm-val">
				<textarea name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).']" '.$option['class'].'></textarea>
				</span>
				</div>
				';
			}

			//if field = time
			/*
			if($form->field_type == 'time'){
				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';
			    $output .='<span class="frm-val">';
				$output .= '<input type="text" name="'.$option['name'].'['.$option['id'].']['.$form->label.'][hh]" '.$option['class'].' style="width:30px">';
				$output .= '<input type="text" name="'.$option['name'].'['.$option['id'].']['.$form->label.'][mm]" '.$option['class'].' style="width:30px">';
				$output .= '<input type="text" name="'.$option['name'].'['.$option['id'].']['.$form->label.'][ss]" '.$option['class'].' style="width:30px">';
				$output .= '</span>
				</div>';
			}
			*/

			//if field = time
			if(@$form->field_type == 'time'){

				//set hours select option
				$hours = '<select name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).'][hh]" />';
				for ($i=0; $i <= 24 ; $i++) { 
					$hours .= '<option value="'.$i.':00">'.$i.':00</option>';
				}
				$hours .= '</select>';

				//set minutes select option

				//set hours select option
				$minutes = '<select name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).'][mm]" />';
				for ($i=0; $i <= 6 ; $i++) {
					$k = $i *10;
					$minutes .= '<option value="'.$k.'">'.$k.'</option>';
				}
				$minutes .= '</select>';

				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';
			    $output .='<span class="frm-val">';
			    $output .=$hours;
			    $output .=$minutes;				
				$output .= '</span>
				</div>';
			}

			//if field = date
			if (@$form->field_type == 'date') {
				$class = substr_replace($option['class'], ' datepicker"', -1);
				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';
				$output .= '<span class="frm-val">
				<input type="text" name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).']" '.$class.'>
				</span>
				</div>';

			}



			//if field = checkbox
			if (@$form->field_type == 'checkboxes') {
				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';

			    $output .= '<span class="frm-val">';
				foreach ($form->field_options->options as $opt => $checkbox) {
					$checked = $checkbox->checked === true ? 'checked="checked"' : '';
					$output .= '<input type="checkbox" value="'.$checkbox->label.'" name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).'][]" '.$option['class'].' '.$checked.'>';
					$output .= $checkbox->label;
				}
				if (isset($form->field_options->include_other_option) and $form->field_options->include_other_option == 1) {
					$output .= '<input type="text" name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).']" '.$option['class'].'>';
					$output .= 'Other';			
				}

				$output .= ' </span>
				</div>';
			}


			//if field = radio
			if (@$form->field_type == 'radio') {
				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';
			    $output .='<span class="frm-val">';
				foreach ($form->field_options->options as $opt => $checkbox) {
					$checked = $checkbox->checked === true ? 'checked="checked"' : '';
					$output .= '<input type="radio" value="'.$checkbox->label.'" name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).']" '.$option['class'].' '.$checked.'>';
					$output .= $checkbox->label;
				}
				if (isset($form->field_options->include_other_option) and $form->field_options->include_other_option == 1) {
					$output .= '<input type="text" name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).']" '.$option['class'].'>';
					$output .= 'Other';			
				}

				$output .= '   </span>
				</div>';

			}


			//if field = dropdown
			if (@$form->field_type == 'dropdown') {
				$output .= '<div class="f-row">
			    <span class="frm-label">
			    '.$form->label.' :<span class="c-f00">*</span>
			    </span>';
			    $output .='<span class="frm-val">';
				$output .= '<select name="'.$option['name'].'['.$option['id'].']['.replace_chars($form->label).']" '.$option['class'].'>';
				foreach ($form->field_options->options as $opt => $checkbox) {
					$selected = $checkbox->checked === true ? 'checked="checked"' : '';
					$output .= '<option value="'.$checkbox->label.'" '.$selected.'>'.$checkbox->label.'</option>';
				}
				$output .= '</select>';
				$output .= '   </span>
				</div>';
			}

			//$output .= '<br>';


		}

		
		if ($output != '' and $option['button'] != false) {
			

			$output .= '<input type="hidden" name="'.$option['name'].'_id" value="'.$option['id'].'">';
			$output .= '<input type="hidden" name="'.$option['name'].'_name" value="'.$option['extra_name'].'">';
			$output .= '<input type="hidden" name="currency" value="'.$option['currency'].'">';
			$output .= '<input type="hidden" name="user_currency" value="'.$option['user_currency'].'">';
			$output .= '<input type="hidden" name="currency_rate" value="'.$option['currency_rate'].'">';
			//$output .= '<input type="button" value="Add" id="button'.$option['id'].'" />';
			$output .= '<input type="hidden" name="type'.$option['id'].'" id="extra_type'.$option['id'].'" value="add">';
			$output .= '<script>';


			$output .= "
			$(function() {
			$('#button".$option['id']."').click(function () {
				form_to_arr('.extra_form".$option['id']."','add');
				var pack = $(this).parents('.extra-pack');
			    $('.p-btn-book', pack).html('<img src=\"".site_url('assets/front/img')."/check.png\" alt=\"Ok\" />');
				CloseForm($(this));
				$('#button".$option['id']."').fadeOut();
			    
			})

			$('#cancel".$option['id']."').click(function () {
				form_to_arr('.extra_form".$option['id']."','delete');
				var pack = $(this).parents('.extra-pack');
		    	$('.p-btn-book', pack).html('Book');
			    CloseForm($(this));
				$('#button".$option['id']."').fadeIn();
			    
			})
			});
			";

			/*
			$output .= "$('#button".$option['id']."').click(function () {
						    form_to_arr('.extra_form".$option['id']."');
						});";
			*/
			
			$output .= '</script>';
		
			//$output .= '<input type="button" value="Add" id="button'.$option['id'].'" />';
			
			$output .= '
                    <a class="btn-cancel" id="cancel'.$option['id'].'">cancel</a>
                    <a class="p-btn p-btn-confirm" id="button'.$option['id'].'">Confirm</a>';
             
			
		}
		
		$output .= '</div>';

		return $output;
	}else{

		return false;
	}

	

}

/*
*	List Countries from cache, if not cached, get from db and cache
*/
function countries(){
	$ci =& get_instance();
	$ci->load->driver('cache',array('apdapter'=>'file','backup'=>'file'));
	$file = 'countries';
	if (!$cache = $ci->cache->get($file)) {
		$cache = $ci->db->query("SELECT * FROM country")->result();
	 	$ci->cache->file->save('countries', $cache, 5000);
	}

	return $cache;

}

/*
* Generate Alpha Numeric ID. Used for reservation code
* 
* USAGE
*	rand_uniqid(9007199254740989); will return 'PpQXn7COf'
*
*	rand_uniqid('PpQXn7COf', true); will return '9007199254740989'
*/
function rand_uniqid($in, $to_num = false, $pad_up = false, $passKey = null){
    $index = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ($passKey !== null) {

        for ($n = 0; $n<strlen($index); $n++) {
            $i[] = substr( $index,$n ,1);
        }

        $passhash = hash('sha256',$passKey);
        $passhash = (strlen($passhash) < strlen($index))
            ? hash('sha512',$passKey)
            : $passhash;

        for ($n=0; $n < strlen($index); $n++) {
            $p[] =  substr($passhash, $n ,1);
        }

        array_multisort($p,  SORT_DESC, $i);
        $index = implode($i);
    }

    $base  = strlen($index);

    if ($to_num) {
        // Digital number  <<--  alphabet letter code
        $in  = strrev($in);
        $out = 0;
        $len = strlen($in) - 1;
        for ($t = 0; $t <= $len; $t++) {
            $bcpow = bcpow($base, $len - $t);
            $out   = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
        }

        if (is_numeric($pad_up)) {
            $pad_up--;
            if ($pad_up > 0) {
                $out -= pow($base, $pad_up);
            }
        }
        $out = sprintf('%F', $out);
        $out = substr($out, 0, strpos($out, '.'));
    } else {
        // Digital number  -->>  alphabet letter code
        if (is_numeric($pad_up)) {
            $pad_up--;
            if ($pad_up > 0) {
                $in += pow($base, $pad_up);
            }
        }

        $out = "";
        for ($t = floor(log($in, $base)); $t >= 0; $t--) {
            $bcp = bcpow($base, $t);
            $a   = floor($in / $bcp) % $base;
            $out = $out . substr($index, $a, 1);
            $in  = $in - ($a * $bcp);
        }
        $out = strrev($out); // reverse
    }

    return $out;
}


/*
* Used in front select - option
*/
function checkCartRoom($room_id,$qty,$promo){
	$response = false;

	$ci =& get_instance();
	$user_cart = $ci->session->userdata('user_cart');

	if (!$user_cart) {
		$response = false;
	}else{
		foreach ($user_cart as $key => $cart) {
			if ($cart['room_id'] == $room_id and $cart['qty'] == $qty and $cart['promotion'] ==$promo) {
				$response = true;
			}
		}
	}
	
	

	if ($response == TRUE) {
		echo 'selected="selected"';
	}

}

function cart_info(){
	$response = array();
	$ci =& get_instance();

	$options = $ci->session->userdata('options');
	$response['extras']['total_user_price'] = 0;
	$response['extras']['total_price'] = 0;

	if ($ci->session->userdata('user_cart')) {
		
		$total_price = 0;
		$total_user_price = 0;
		$total_room  = 0;
		foreach ($ci->session->userdata('user_cart') as $key => $cart) {
			$total_price += $cart['price'] * $cart['qty'] * $options['nights'];
			$total_user_price += $cart['user_price'] * $cart['qty'] * $options['nights'];
			$total_room += $cart['qty'];
		}

		$response['cart']['total_price'] = show_price($total_price);
		$response['cart']['total_user_price'] = show_price($total_user_price,$options['currency_rate']);
		$response['cart']['total_room'] = $total_room;
	}

	if ($ci->session->userdata('user_extras')) {
		$total_extra_price = 0;
		foreach ($ci->session->userdata('user_extras') as $key => $cart) {
			$total_extra_price += $cart['price'];
		}

		$response['extras']['total_price'] = show_price($total_extra_price);
		$response['extras']['total_user_price'] = show_price($total_extra_price,$options['currency_rate']);
	}

	$response['total_price'] = $response['cart']['total_price'] + $response['extras']['total_price'];
	$response['total_user_price'] = $response['cart']['total_user_price'] + $response['extras']['total_user_price'];

	return $response;

}

/* GENERATE POLICIES START */
function get_policy($id){
	$ci =& get_instance();
	$p = $ci->db->query("SELECT policy_details FROM policies WHERE id=$id")->row();
	return json_decode($p->policy_details);
}

function checkbox_selected($value){
	if (isset($value)) {
		return true;
	}else{
		return false;
	}
	
}

function no_show_select($value=NULL){

	if ($value == 'no_show_days') {
		$lang  = 'no_show_method_days';
	}elseif ($value == 'no_show_perc') {
		$lang = 'no_show_method_perc';
	}else{
		$lang = 'no_show_method_fix';
	}

	return $lang;
}
/* GENERATE POLICIES END */

function onAjaxTest(){
	echo 'test';
}


/*
* Get diffirence by two dates
* @param YYYY-MM-DD
* @param YYYY-MM-DD
* @var format information http://php.net/manual/tr/function.date-diff.php#115065
*/
function dateDifference($date_1 , $date_2 , $differenceFormat = '%d' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}

/*
* DEPRECATED
*/
function get_extra_forms($id){
	$ci =& get_instance();
	$e = $ci->db->query("SELECT forms FROM extras WHERE id=$id")->row();
	return json_decode($e->forms);
}

function get_extra_image($id){
	$ci =& get_instance();
	$e = $ci->db->query("SELECT image FROM extras WHERE id=$id")->row();
	return $e->image;
}

/*
* Get user location 
*/
function user_location($ip){
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

	if($query && $query['status'] == 'success') {
		return $query['countryCode'];
	}else{
		return false;
	}

}

function url_slug($s) {
 $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
 $eng = array('s','S','i','I','i','g','G','u','U','o','O','C','c','(',')','-',':','');
 $s = str_replace($tr,$eng,$s);
 //$s = strtolower($s);
 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
 $s = preg_replace('/\s+/', ' ', $s);
 $s = preg_replace('|-+|', '-', $s);
 $s = preg_replace('/#/', '', $s);
 $s = str_replace('.', '', $s);
 $s = trim($s, ' ');
 return $s;
}


function slug($string)
{
    return trim(preg_replace('~[^0-9a-z]+~i', ' ', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), ' ');
}


/* Bak sonra 
function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => false,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	//$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
*/