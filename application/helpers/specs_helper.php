<?php

function hotel_specs($id=0){
	$specs = array(
		'1'	=> lang('elevator'),
		'2' => lang('disabled_persons'),
		'3' => lang('guarded_parking'),
		'4' => lang('free_parking'),
		'5' => lang('garage'),
		'6' => lang('conferance_saloon'),
		'7' => lang('wifi'),
		'8' => lang('fitness_center'),
		'9' => lang('wellness_center'),
		'10'=> lang('turkish_bath'),
		'11'=> lang('massage'),
		'12'=> lang('outdoor_swimming_pool'),
		'13'=> lang('indoor_swimming_pool'),
		'14'=> lang('laundry_service'),
		'15'=> lang('car_central'),
		'16'=> lang('private_beach'),
		'17'=> lang('public_beach'),
		'18'=> lang('baby_sitting_service'),
		'19'=> lang('hair_dresser'),
		'20'=> lang('internation_newspapers'),
		'21'=> lang('exchange_office'),
		'22'=> lang('transfer_service'),
		'23'=> lang('pets_allowed'));

	if ($id > 0) {
		return $specs[$id];
	}else{
		return $specs;
	}
}

function restourant_specs($id=0){
	$specs = array(
		'1'	=> lang('main_restourant'),
		'2' => lang('alacarte_restourant'),
		'3' => lang('tavern_restourant'),
		'4' => lang('snack_restourant'),
		'5' => lang('beach_restourant'),
		'6' => lang('piano_restourant'));

	if ($id > 0) {
		return $specs[$id];
	}else{
		return $specs;
	}

}

function sport_specs($id=0){
	$specs = array(
		'1'	=> lang('casino'),
		'2' => lang('disco'),
		'3' => lang('night_club'),
		'4' => lang('beach_bar'),
		'5' => lang('bowling'),
		'6' => lang('mini_golf'),
		'7' => lang('tennis'),
		'8' => lang('walking_paths'),
		'9' => lang('water_sports'),
		'10'=> lang('animation'),
		'11'=> lang('local_excursions'));

	if ($id > 0) {
		return $specs[$id];
	}else{
		return $specs;
	}
}


function currencies($id=0){
	$arr = array(
		'1' => 'AUD',
		'2' => 'BGN',
		'3' => 'CAD',
		'4' => 'CHF',
		'5' => 'CNY',
		'6' => 'CZK',
		'7' => 'DKK',
		'8' => 'EUR',
		'9' => 'GBP',
		'10' => 'HKD',
		'11' => 'HRK',
		'12' => 'HUF',
		'13' => 'IDR',
		'14' => 'ILS',
		'15' => 'INR',
		'16' => 'JPY',
		'17' => 'KRW',
		'18' => 'LTL',
		'19' => 'MXN',
		'20' => 'MYR',
		'21' => 'NOK',
		'22' => 'NZD',
		'23' => 'PHP',
		'24' => 'PLN',
		'25' => 'RON',
		'26' => 'RUB',
		'27' => 'SEK',
		'28' => 'SGD',
		'29' => 'THB',
		'30' => 'TRY',
		'31' => 'USD',
		'32' => 'ZAR');

	if ($id > 0) {
		return $arr[$id];
	}else{
		return $arr;
	}

}

function hotel_category($id=NULL){
	$cats = array(
		'0' => lang('cat_0_star'),
		'1' => lang('cat_1_star'),
		'2' => lang('cat_2_star'),
		'3' => lang('cat_3_star'),
		'4' => lang('cat_4_star'),
		'5' => lang('cat_5_star'));

	if (NULL != $id) {
		return $cats[$id];
	}else{
		return $cats;
	}
}
