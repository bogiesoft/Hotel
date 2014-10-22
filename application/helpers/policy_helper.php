<?php

function twentyfour_hour_selectbox($name,$value=NULL){
	$output = '<select name="'.$name.'">';
	for ($i=1; $i <=24; $i++) { 
		$selected = $value == $i ? 'selected="selected"' : '';
		$output .= '<option value="'.$i.'" '.$selected.'>'.$i.':00</option>';
	}
	$output .= '</select>';

	echo $output;
}

function age_selectbox($name,$value=NULL){
	$output = '<select name="'.$name.'">';
	for ($i=1; $i <=18; $i++) { 
		$selected = $value == $i ? 'selected="selected"' : '';
		$output .= '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
	}
	$output .= '</select>';

	echo $output;
}

function no_show_select($value=NULL){

	$no_show_days = $value=="no_show_days" ? 'selected="selected"' : '';
	$no_show_perc = $value=="no_show_perc" ? 'selected="selected"' : '';
	$no_show_perc_guarantee = $value=="no_show_perc_guarantee" ? 'selected="selected"' : '';

	echo '
	<select name="policy[cancel][no_show_value][no_card_depozit_method]" style="width:240px; height: 20px">
      <option value="no_show_days" '.$no_show_days.'>Seçili konaklamada kişi başına geceleme</option>
      <option value="no_show_perc" '.$no_show_perc.'>Rezervasyon değerininin yüzdesi</option>
      <option value="no_show_perc_guarantee" '.$no_show_perc_guarantee.'>Garanti değerinin yüzdesi</option>
    </select>';
}

function valid_card_select($value=NULL){

	$perc = $value=='perc' ? 'selected="selected"' :'';
	$days = $value=='days' ? 'selected="selected"' :'';
	$fix  = $value=='fix' ? 'selected="selected"' :'';
	
	echo '
	<select name="policy[sales][valid_card][no_card_depozit_method]" style="width:240px; height: 20px">
      <option value="perc" '.$perc.'>Rezervasyon değerininin yüzdesi</option>
      <option value="days" '.$days.'>Seçili konaklamada kişi başına geceleme</option>
      <option value="fix" '.$fix.'>(EUR) Sabit değer</option>
    </select>';
}


function checkbox_selected($value){
	if (isset($value)) {
		$selected = $value =='on' ? 'checked="checked"' : '';
	}else{
		$selected = '';
	}
	
	echo $selected;
}
