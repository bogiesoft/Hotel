<?php

function room_specs($id=0){
	$specs = array(
		'1'	=> lang('room_service'),
		'2' => lang('air_condition'),
		'3' => lang('vcr'),
		'4' => lang('loundry_service'),
		'5' => lang('private_toilet'),
		'6' => lang('fax'),
		'7' => lang('for_families'),
		'8' => lang('sauna'),
		'9' => lang('direct_phone'),
		'10'=> lang('for_disabled'),
		'11'=> lang('jakuzzi'),
		'12'=> lang('internet'),
		'13'=> lang('extra_bed'),
		'14'=> lang('hair_drier'),
		'15'=> lang('modem_line'),
		'16'=> lang('baby_cot'),
		'17'=> lang('minibar'),
		'18'=> lang('wifi'),
		'19'=> lang('water_bed'),
		'20'=> lang('kitchen'),
		'21'=> lang('iron_board'),
		'22'=> lang('sea_view'),
		'23'=> lang('city_view'),
		'24'=> lang('river_view'),
		'25'=> lang('park_view'),
		'26'=> lang('lake_view'),
		'27'=> lang('garden_view'),
		'28'=> lang('trouser_press'),
		'29'=> lang('refrigerator'),
		'30'=> lang('slippers'),
		'31'=> lang('kitchenette'),
		'32'=> lang('safe_box'),
		'33'=> lang('washing_machine'),
		'34'=> lang('microwave'),
		'35'=> lang('tv'),
		'36'=> lang('vip_amenities'),
		'37'=> lang('bathrobe'),
		'38'=> lang('satellite_tv'),
		'39'=> lang('parking'),
		'40'=> lang('tv'),
		'41'=> lang('pay_tv'),
		'42'=> lang('pet_friendly'),
		'43'=> lang('balcony'),
		'44'=> lang('hifi'));

	if ($id > 0) {
		return $specs[$id];
	}else{
		return $specs;
	}
}