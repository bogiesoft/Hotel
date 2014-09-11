<?php

function hotel_specs($id=0){
	$specs = array(
		'1'	=> 'Asansör',
		'2' => 'Engelliler için özellikler',
		'3' => 'Korumalı Park',
		'4' => 'Ücretsiz park',
		'5' => 'Garaj',
		'6' => 'Konferans Toplantı tesisleri',
		'7' => 'Wi-Fi',
		'8' => 'Fittness Centre',
		'9' => 'Sağlık Merkezi',
		'10'=> 'Türk Hamamı / Buhar Banyosu',
		'11'=> 'Masaj',
		'12'=> 'Açık Havuz',
		'13'=> 'Kapalı Havuz',
		'14'=> 'Çamaşır servisi',
		'15'=> 'Oto kiralama',
		'16'=> 'Özel plaj',
		'17'=> 'Halk Plajı',
		'18'=> 'Bebek bakım servisi',
		'19'=> 'Kuaför',
		'20'=> 'Uluslararası gazeteler',
		'21'=> 'Döviz Bürosu',
		'22'=> 'Transfer Servisi',
		'23'=> 'Ev hayvanlarına izin verilir');

	if ($id > 0) {
		return $specs[$id];
	}else{
		return $specs;
	}
}

function restourant_specs($id=0){
	$specs = array(
		'1'	=> 'Ana Restaurant',
		'2' => 'A la carte restaurant',
		'3' => 'Local Cousine',
		'4' => 'Snack-Bar',
		'5' => 'Plaj Restaurant',
		'6' => 'Piano-Bar');

	if ($id > 0) {
		return $specs[$id];
	}else{
		return $specs;
	}

}

function sport_specs($id=0){
	$specs = array(
		'1'	=> 'Casino',
		'2' => 'Disko',
		'3' => 'Gece Klübü',
		'4' => 'Plaj Bar',
		'5' => 'Bowling',
		'6' => 'Mini Golf',
		'7' => 'Tenis Kortu',
		'8' => 'Yürüme Yolu',
		'9' => 'Su Sporları',
		'10'=> 'Animasyon',
		'11'=> 'Yerel Uçuşlar');

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

function hotel_category($id){
	$cats = array(
		'0' => 'Belirtilmemiş',
		'1' => '1 Yıldız',
		'2' => '2 Yıldız',
		'3' => '3 Yıldız',
		'4' => '4 Yıldız',
		'5' => '5 Yıldız');

	if ($id > 0) {
		return $cats[$id];
	}else{
		return $cats;
	}
}
