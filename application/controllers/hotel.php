<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {

	var $total_room_price;
	var $user_cart;
	var $adults = 2;
	var $children = 0;
	var $nights = 1;
	var $start_date;
	var $end_date;
	var $currency;
	var $user_currency;
	var $currency_rate = 1;

	function __construct(){
		parent::__construct();
		$this->load->helper('general_helper');
		$this->load->helper('room_helper');
		$this->load->model('front_model');
		$this->load->library('session');

	}

	function index(){
		//print_r($this->total_room_price);
		$hotel_id = $this->input->get('hotel_id');

		//if hotel id is not set return error
		if (!$hotel_id) {
			exit('Error');
		}
		//get hotel info
		$hotel = $this->front_model->hotel_info($hotel_id);

		if (!$hotel) {
			exit('Hotel not found.');
		}

		//options
		$default_lang 		= $this->session->userdata('default_lang') ? $this->session->userdata('default_lang') : 'en';
		$this->start_date 	= $this->input->get('checkin') ? $this->input->get('checkin') : date('d-m-Y');
		$this->end_date 	= $this->input->get('checkout') ? $this->input->get('checkout') : date('d-m-Y');
		$this->adults		= $this->input->get('adults') ? $this->input->get('adults') : '2';
		$this->children		= $this->input->get('children') ? $this->input->get('children') : '0';
		$this->currency		= $hotel->currency;
		//$this->user_currency = isset($this->session->userdata('currency')) ? $this->session->userdata('currency') : $this->currency;
		$this->user_currency= 'TRY';
		if ($this->user_currency != $this->currency) {
			$this->currency_rate = currency_rates($this->currency,$this->user_currency);
		}

		//make dates to yy-mm-dd format
		$this->start_date = date('Y-m-d', strtotime($this->start_date));
		$this->end_date = date('Y-m-d', strtotime($this->end_date));

		//salaklar start date'i end date'den sonrası bir tarihe girerse falan
		if (strtotime($this->start_date) > strtotime($this->end_date)) {
			exit('Checkout Date Error');
		}

		//salaklar geçmişe dönük rezervasyon yapmak isterse
		if (strtotime($this->start_date) < strtotime(date('Y-m-d'))) {
			exit('Checkin Date Error');
		}

		//load languages
		$this->lang->load('reservation/rooms',$default_lang);


		//get rooms
		$search = array('child' => $this->children,
			'adults' => $this->adults,
			'language' => $default_lang);

		$arr = array();
		$rooms = $this->front_model->get_hotel_rooms($hotel_id,$search);

		if (FALSE === $rooms) {
			$arr['rooms'] = 0;
		}else{
			
			foreach (date_range($this->start_date,$this->end_date) as $k => $d) {

				$arr['dates'][$d] = $d;
				//set nights
				$this->nights = count($arr['dates'])-1;
				foreach ($rooms as $key => $r) {

					$arr['rooms'][$r->id]['name'] 		= $r->name;
					$arr['rooms'][$r->id]['title'] 		= $r->title;
					$arr['rooms'][$r->id]['content'] 	= $r->content;
					$arr['rooms'][$r->id]['units'] 		= $r->room_units;
					$arr['rooms'][$r->id]['max_capacity']= $r->max_capacity;
					$arr['rooms'][$r->id]['max_adult']	= $r->max_adult;
					$arr['rooms'][$r->id]['max_child']	= $r->max_child;
					$arr['rooms'][$r->id]['photos'] 	= $this->front_model->get_room_photos($r->id);
					$arr['rooms'][$r->id]['prices'][$d] = $this->front_model->get_bar_by_room($d,$r->id);
					$arr['rooms'][$r->id]['prices'][$d]['room_name'] = $r->name;
					$arr['rooms'][$r->id]['prices'][$d]['room_id'] = $r->id;
					$arr['rooms'][$r->id]['prices'][$d]['room_capacity'] = $r->capacity;
					$arr['rooms'][$r->id]['prices'][$d]['room_child'] = $r->min_child;

				}
			}
		}
		


		//get promotions
		$promotions = $this->front_model->get_promotions($hotel_id);

		//set promotions by rooms id
		if ($promotions) {
			$promotion = array();
			foreach ($promotions as $k => $p) {
				$rooms = explode(',', $p['rooms']);
				foreach ($rooms as $r => $room) {
					$promotion[$room][$p['id']] = $p;
					$promotion[$room][$p['id']]['rule'] = 1;
					
				}
			}

			$arr['promotions'] 	= $promotion;
		}

		$data['options'] 		= array(
			'nights' => $this->nights,
			'adults'=>$this->adults,
			'children'=>$this->children,
			'checkin'=>$this->start_date,
			'checkout'=>$this->end_date,
			'currency'=>$this->currency,
			'user_currency' => $this->user_currency,
			'currency_rate'=>$this->currency_rate);

		$data['hotel_info'] 	= $hotel;
		$data['rooms'] 			= $arr['rooms'];

		//create prices and set session 
		//by rooms and promotions
		$this->calculate_room_prices($data['rooms']);
		@$this->calculate_promo_prices($arr['promotions']);
		

		//set promotion rules
		$data['promotion']		= @$this->set_promotion_rules($arr['promotions']);
		
		$data['prices'] 		= $this->session->userdata('room_prices');
		echo '<!--';
		echo '<pre>';
		print_r($data);
		print_r($this->session->userdata('user_cart'));
		echo '-->';
		

		$this->load->view('front/index',$data);

	}

	/*
	* Calculate room prices
	*/
	private function calculate_room_prices($arr){

		$total_room_price = new StdClass;

		if ($this->adults == 1) {
			$type = 'single_price';
		}elseif($this->adults == 2){
			$type = 'double_price';
		}elseif($this->adults >= 3){
			$type = 'triple_price';
		}

		/* TO DO!!!!
		* ekstra girilen fiyata çözüm bulunacak
		*/
		
		$total_room_price = new StdClass();

		//if rooms available
		if (!is_array($arr)) {
			$total_room_price = false;
		}else{

			foreach ($arr as $room_id => $r) {
				
				$total_child_price = 0;
				//unset first date (yoksa hem giriş gününe hemde çıkış gününe fiyat eklemiş oluyoruz mk)
				unset($r['prices'][$this->start_date]);


				foreach ($r['prices'] as $date => $p) {

					//if price is unit price
					if (isset($p['price_type']) and $p['price_type'] == 1) {
						@$total_room_price->$room_id->price = $p['base_price'];
					}else{

						//if adults more than 3
						if ($this->adults >= 4) {
							$total_adult = $this->adults - 3;
							$total_adult_price = $total_adult * $p['extra_adult'];
							@$total_room_price->$room_id->price += $p['triple_price'];
							@$total_room_price->$room_id->price += $total_adult_price;

						}else{
							@$total_room_price->$room_id->price += $p[$type];
						}
						
					}

					//calculate children prices
					if ($this->children !=0 and isset($p['child_price'])) {
						
						$child_price = json_decode($p['child_price'],true);
						$child_ages = $this->input->get('children_ages');
						//print_r($child_price);
						foreach ($child_ages as $key => $age) {
							$total_child_price += $this->get_child_price_by_age($age,$child_price);
						}

					}
							
				}

				$total_room_price->$room_id->price += $total_child_price;
			}

		}

		$this->session->set_userdata('room_prices',$total_room_price);

	}
	/*
	* Calculate children prices
	* Used in calculate_room_prices()
	*/
	private function get_child_price_by_age($age,$arr){
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
	private function calculate_promo_prices($promotions){

		$room_prices = $this->session->userdata('room_prices');

		foreach ($room_prices as $rid => $room) {
			
			if (isset($promotions[$rid])) {
				
				foreach ($promotions[$rid] as $pid => $promo) {
					$price = $room->price - ($room->price * $promo['promotion_discount'] / 100);
					@$room->promotions->$pid->price = $price;

				}

			}		
		}

		return $this->session->set_userdata('room_prices',$room_prices);
	
	}

	/*
	* Set Promotion Rules
	* 1=basic_deal, 2=minimum_stay, 3=early_booker,4=last_minute,5=24Hour
	*/
	private function set_promotion_rules($promotions){

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
				//check room availibity or stoped values for reservation dates
				foreach (date_range($this->start_date,$this->end_date) as $d => $date) {

					$available = promotion_available($date,$pid,$rid);

					if (!$available or $available['available'] < 1 or $available['stoped'] == 1) {
						$new_arr[$rid][$pid]['rule'] = 0;
					}
				}

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
					if (strtotime(date('Y-m-d H:i:s')) <= strtotime($promo_start)) {
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


	//add to cart başlasın
	//burayı düzgünce yapmak lazım
	function user_cart(){
		
		$user_cart = $this->session->userdata('user_cart');

		$room_id 	= $this->input->post('room');
		$qty 		= $this->input->post('qty');
		$promotion 	= $this->input->post('promotion');

		$room_prices = $this->session->userdata('room_prices');

		if ($this->input->post('type') == 'delete' and $user_cart[$room_id]) {
			unset($user_cart[$room_id]);
		}else{
			$arr =  array('qty' => $qty,'promotion'=>$promotion,'price'=>$room_prices->$room_id->price );
			$user_cart[$room_id] = $arr;
		}

		$this->session->set_userdata('user_cart',$user_cart);
		
		//get total items in cart
		$response['total_price'] = 0;
		$response['total_qty'] = 0;

		//print_r($this->session->userdata('user_cart')); exit;
		foreach ($this->session->userdata('user_cart') as $r => $v) {
			$response['total_price']  	+= $v['price']*$v['qty'];
			$response['total_qty'] 		+= $v['qty'];
		}

		echo json_encode($response);
		//print_r($user_cart); exit;
		//print_r($this->session->userdata);
	}


	/*
	* Print Currency Rates JSON
	*/
	public function currency_rates(){
		// get current exchange rates
		$cur = $this->input->get('c');
		$this->load->driver('cache', array('apdapter'=>'apc','backup'=>'file'));
		$file = 'currency-rates-'.$cur;

		if (!$cache = $this->cache->get($file)) {
			$exurl = 'http://api.fixer.io/latest?base='.$cur;
			$ch = curl_init($exurl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$json_response_content = curl_exec($ch);
			curl_close($ch);
			$cache = $json_response_content;
	 		$this->cache->file->save('currency-rates-'.$cur, $json_response_content, 5000);
	 		
	 	}

	 	print $cache;
	 	//$rate = $cache['rates'][$cur2];
	 	// $rate;
		
	}



}
