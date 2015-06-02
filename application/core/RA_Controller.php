<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RA_Controller extends MY_Controller{
	

	var $total_room_price;
	var $user_cart;
	public $adults = 2;
	public $children = 0;
	public $nights = 1;
	public $start_date;
	public $end_date;
	public $currency = 'EUR';
	public $user_currency;
	public $currency_rate = 1;

	function __construct(){

		parent::__construct();

		$this->lang->load('reservation/rooms','en');


		//generate session id
		if (!$this->session->userdata('my_session_id')) {
			$uniqueId = uniqid($this->input->ip_address(), TRUE);
    		$uniqidId = md5($uniqueId);
			$this->session->set_userdata("my_session_id", $uniqueId);
		}
    	

	}

	/*
	* Calculate room prices
	* Used in hotel controller and action controller
	* 
	*/
	function calculate_room_prices($arr){

		$total_room_price = new stdClass();
		

		if ($this->adults == 1) {
			$type = 'single_price';
		}elseif($this->adults == 2){
			$type = 'double_price';
		}elseif($this->adults >= 3){
			$type = 'triple_price';
		}

		//if rooms available
		if (!is_array($arr)) {
			$total_room_price = false;
		}else{

			$sub_total = 0;
			

			foreach ($arr as $room_id => $r) {

				$total_child_price = 0;
				$adult_price = 0;

				//set daily prices
				$daily_adult_price = 0;
				$daily_child_price = 0;
				
				//unset first date (yoksa hem giriş gününe hemde çıkış gününe fiyat eklemiş oluyoruz mk)
				unset($r['prices'][$this->start_date]);
				$price_by_dates = array();

				foreach ($r['prices'] as $date => $p) {

					$sub_total1 = 0;
					//if price is unit price
					if (isset($p['price_type']) and $p['price_type'] == 1) {
						$adult_price += $p['base_price'];
						$daily_adult_price = $p['base_price'];
					}else{

						//if adults more than 3
						if ($this->adults >= 4) {
							$total_adult = $this->adults - 3;
							$total_adult_price = $total_adult * $p['extra_adult'];
							$adult_price += $p['triple_price'];
							$adult_price += $total_adult_price;

							$daily_adult_price = $p['triple_price'] + $total_adult_price;

						}else{
							$adult_price += $p[$type];
							$daily_adult_price = $p[$type];

						}
						
					}

					//calculate children prices
					if ($this->children !=0 and isset($p['child_price'])) {
						
						$child_price = json_decode($p['child_price'],true);
						$child_ages = $this->input->get('children_ages');
						//print_r($child_price);
						foreach ($child_ages as $key => $age) {
							$total_child_price += $this->get_child_price_by_age($age,$child_price);
							$daily_child_price = $this->get_child_price_by_age($age,$child_price);
						}

					}

					//güne göre fiyatları hesapla
					//tarihe göre promosyon stoped ise burdaki gün fiyatı hesaplanacak
					$price_by_dates[$date] = $daily_adult_price + $daily_child_price;
		
				}

				@$total_room_price->$room_id->by_date = $price_by_dates;
				@$total_room_price->$room_id->price += $adult_price + $total_child_price;
				
			}


			

			//$total_room_price->$room_id->price = $total_room_price->$room_id->price * $this->nights;

		}
		
		$this->session->set_userdata('prices_all',$total_room_price);
	
		

	}
	/*
	* Calculate children prices
	* Used in calculate_room_prices()
	*/
	function get_child_price_by_age($age,$arr){
		$price = 0;
		if (is_array($arr)) {
			$i = 0;
			foreach ($arr as $key => $child) {
				$i++;
				if ($age >= $child['min'] && $age <= $child['max']) {
					$price = $child['price'];
				}
			}
		}
		return $price;

	}

	/*
	* Calculate promotion prices by promotion_discount
	*/
	function calculate_promo_prices($promotions){

		$room_prices = $this->session->userdata('prices_all');

		if (NULL == $room_prices) {
			return false;

		}

		foreach ($room_prices as $rid => $room) {
			
			if (isset($promotions[$rid])) {
				
				foreach ($promotions[$rid] as $pid => $promo) {
					$price = $room->price - ($room->price * $promo['promotion_discount'] / 100);
					@$room->promotions->$pid->price = $price;

				}

			}		
		}

		return $this->session->set_userdata('prices_all',$room_prices);
	
	}

	/*
	* Calculate extra prices
	*/
	function calculate_extra_prices($extras){
		$extra_prices = new StdClass();

		$room_prices = $this->session->userdata('prices_all');

		if (NULL == $room_prices) {
			return false;

		}
		
		foreach ($extras as $key => $extra) {
			$prices = json_decode($extra['price']);
            
            //set price per unit or person
            if($extra['per'] ==2){
                $price = $prices->unit;
            }else{
                $price = calculate_extra_price($prices,$this->adults);
            }

			@$extra_prices->$extra['id']->price = $price;
		}
		//print_r($extra_prices); exit;
		//print_r($room_prices); exit;
		$room_prices->extras = $extra_prices;
		//print_r($room_prices); exit;
		return $this->session->set_userdata('prices_all',$room_prices);

	}


	/*
	* Set Promotion Rules
	* 1=basic_deal, 2=minimum_stay, 3=early_booker,4=last_minute,5=24Hour
	*/
	function set_promotion_rules($promotions){

		$new_arr = $promotions;

		foreach ($promotions as $rid => $promo) {
			
			foreach ($promo as $pid => $p) {
				//standart rules
				//check promotion dates
				if($p['promotion_type'] != 4){
					if (strtotime(date('Y-m-d')) < strtotime($p['start_date']) or strtotime(date('Y-m-d')) > strtotime($p['end_date']) ) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}
				}

				/*
				* TODO:
				* Burası için algoritma değişecek
				* Seçilen tarihlerde 1 tane stoped varsa hiç gösterilmiyor promotion
				* Fiyat hesaplarken stoped olmayan tarihler yerine normal fiyat üzerinden hesaplanacak
				*/
				//check room availibity or stoped values for reservation dates
				foreach (date_range($this->start_date,$this->end_date) as $d => $date) {

					$available = promotion_available($date,$pid,$rid);

					if (!$available or $available['available'] < 1 or $available['stoped'] == 1) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}
				}
				/* TODO  END*/ 


				//minimum stay rules
				if ($p['promotion_type'] == 2) {
					//check total nights for minimum stay
					if ($this->nights < $p['min_stay']) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}
				}

				//early booker rules
				if ($p['promotion_type'] == 3) {
					//booking days for reservation
					if (strtotime($this->start_date) < strtotime($p['booking_start']) or strtotime($this->end_date) > strtotime($p['booking_end']) ) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}
				}

				if ($p['promotion_type'] == 4) {
					//if reservation dates are not between promo dates, disable promo
					if (strtotime($this->start_date) < strtotime($p['start_date']) or strtotime($this->start_date) > strtotime($p['end_date']) ) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}

					$promo_starts = date('Y-m-d H:i:s',strtotime("-".$p['last_min_qty'].' '.$p['last_min_val'], strtotime($this->start_date.' 00:00:00')));

					//if today is lower than promo start, disable promo
					if (strtotime(date('Y-m-d H:i:s')) <= strtotime($promo_starts)) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}

					$new_arr[$rid][$pid]['promo_start'] = $promo_starts;
				}

				//24h rules
				if ($p['promotion_type'] == 5) {
					//$new_arr[$rid][$pid]['rule'] = strtotime($p['twentyfour_date'].' 23:59:59');

					//$p['twentyfour_date'];
					//booking days for reservation
					if (strtotime(date('Y-m-d H:i:s')) >= strtotime($p['twentyfour_date'].' 23:59:59')) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}
				}

			}

		}
		return $new_arr;

	}

}