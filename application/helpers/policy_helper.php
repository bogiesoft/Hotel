<?php

function twentyfour_hour_selectbox($name,$value=NULL){
	$output = '<select name="'.$name.'">';
	for ($i=1; $i <=24; $i++) { 
		$selected = $value == $i ? 'selected="selected"' : '';
		$output .= '<option value="'.$i.'" '.$selected.'>'.$i.':00</option>';
	}
	$output .= '</select>';

	return $output;
}

function age_selectbox($name,$value=NULL){
	$output = '<select name="'.$name.'">';
	for ($i=1; $i <=18; $i++) { 
		$selected = $value == $i ? 'selected="selected"' : '';
		$output .= '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
	}
	$output .= '</select>';

	return $output;
}

function no_show_select_admin($value=NULL){

	$no_show_days = $value=="no_show_days" ? 'selected="selected"' : '';
	$no_show_perc = $value=="no_show_perc" ? 'selected="selected"' : '';
	$no_show_perc_guarantee = $value=="no_show_perc_guarantee" ? 'selected="selected"' : '';

	return '
	<select name="policy[cancel][no_show_value][no_card_depozit_method]" style="width:240px; height: 20px">
      <option value="no_show_days" '.$no_show_days.'>'.lang('no_show_method_days').'</option>
      <option value="no_show_perc" '.$no_show_perc.'>'.lang('no_show_method_perc').'</option>
      <option value="no_show_perc_guarantee" '.$no_show_perc_guarantee.'>'.lang('no_show_method_fix').'</option>
    </select>';
}

function valid_card_select($value=NULL){

	$perc = $value=='perc' ? 'selected="selected"' :'';
	$days = $value=='days' ? 'selected="selected"' :'';
	$fix  = $value=='fix' ? 'selected="selected"' :'';
	
	return '
	<select name="policy[sales][valid_card][no_card_depozit_method]" style="width:240px; height: 20px">
      <option value="perc" '.$perc.'>'.lang('depozit_method_perc').'</option>
      <option value="days" '.$days.'>'.lang('depozit_method_days').'</option>
      <option value="fix" '.$fix.'>'.lang('depozit_method_fix').'</option>
    </select>';
}


function checkbox_selected_admin($value){
	if (isset($value)) {
		$selected = $value =='on' ? 'checked="checked"' : '';
	}else{
		$selected = '';
	}
	
	echo $selected;
}
