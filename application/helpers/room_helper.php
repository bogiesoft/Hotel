<?php

function room_specs($id=0){
	$specs = array(
		'1'	=> 'Oda Servisi',
		'2' => 'Klima',
		'3' => 'VCR',
		'4' => 'Çamaşır servisi',
		'5' => 'Özel tuvalet ve duş',
		'6' => 'FAX',
		'7' => 'Aileler için uygundur',
		'8' => 'Sauna',
		'9' => 'Direkt telefon',
		'10'=> 'Engelli hizmetleri',
		'11'=> 'Jakuzi',
		'12'=> 'İnternet girişi',
		'13'=> 'Extra yatak mümkün',
		'14'=> 'Saç kurutma makinesi',
		'15'=> 'Modem Hattı',
		'16'=> 'Bebek Yatağı',
		'17'=> 'Mini Bar',
		'18'=> 'Wi-Fi',
		'19'=> 'Deniz Yatağı',
		'20'=> 'Mutfak',
		'21'=> 'Ütü masası',
		'22'=> 'Deniz Manzaralı',
		'23'=> 'Şehir Manzaralı',
		'24'=> 'Nehir Manzaralı',
		'25'=> 'Park Manzarası',
		'26'=> 'Göl Manzaralı',
		'27'=> 'Bahçe manzaralı',
		'28'=> 'Ütü Presi',
		'29'=> 'Buzdolabı',
		'30'=> 'Terlik',
		'31'=> 'Küçük Mutfak',
		'32'=> 'Odada güvenlik kasası',
		'33'=> 'Çamaşır makinesi',
		'34'=> 'Mikrodalga',
		'35'=> 'Tv',
		'36'=> 'VIP Hizmetleri',
		'37'=> 'Bornoz',
		'38'=> 'Satellite Tv',
		'39'=> 'Park Alanı',
		'40'=> 'Teras',
		'41'=> 'Ödemeli Tv',
		'42'=> 'Hayvan Dostu',
		'43'=> 'Balkon',
		'44'=> 'Hi-Fi');

	if ($id > 0) {
		return $specs[$id];
	}else{
		return $specs;
	}
}