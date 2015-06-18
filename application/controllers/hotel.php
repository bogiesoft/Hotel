<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends RA_Controller {


	function __construct(){
		parent::__construct();
		$this->load->helper('general_helper');
		$this->load->helper('room_helper');
		$this->load->helper('specs_helper');
		$this->load->model('front_model');
		$this->load->library('session');

	}



	function index(){
		$this->lang->load('reservation/hotels','en');
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

		
		//set reservation info false
		$data['reservation'] = false;

		//if change reservation
		if ($this->input->get('res_code') or $this->session->userdata('res_code')) {
			$reservation = $this->front_model->get_reservation($this->input->get('res_code'),$hotel_id);
			if ($reservation) {
				$data['reservation'] = $reservation;

				//set user extras
				$this->session->set_userdata('user_extras',json_decode($reservation->extras,TRUE));
				$this->session->set_userdata('user_cart',json_decode($reservation->rooms,TRUE));

				//set reservation code on session
				$this->session->set_userdata('res_code',$this->input->get('res_code'));
			}
			
		}

		//options
		$default_lang 		= $this->session->userdata('default_lang') ? $this->session->userdata('default_lang') : 'en';
		$this->start_date 	= $this->input->get('checkin') ? $this->input->get('checkin') : date('d-m-Y');
		$this->end_date 	= $this->input->get('checkout') ? $this->input->get('checkout') : date('d-m-Y',strtotime('+1 day',strtotime($this->start_date)));
		$this->adults		= $this->input->get('adults') ? $this->input->get('adults') : '2';
		$this->children		= $this->input->get('children') ? $this->input->get('children') : '0';
		
		$this->currency 	= $hotel->currency;
		//$this->setCurrency($hotel->currency);
		
		//$this->user_currency = isset($this->session->userdata('currency')) ? $this->session->userdata('currency') : $this->currency;
		$this->user_currency = ($this->input->get('cur') and strlen($this->input->get('cur')) == 3) ? $this->input->get('cur') : $this->currency;
		if ($this->user_currency != $this->currency) {
			$this->currency_rate = currency_rates($this->currency,$this->user_currency);
		}

		//make dates to yy-mm-dd format
		$this->start_date = date('Y-m-d', strtotime($this->start_date));
		$this->end_date = date('Y-m-d', strtotime($this->end_date));

		//salaklar start date'i end date'den sonrası bir tarihe girerse falan
		if (strtotime($this->start_date) >= strtotime($this->end_date)) {
			exit('Checkout Date Error');
		}

		//salaklar geçmişe dönük rezervasyon yapmak isterse
		
		if (strtotime($this->start_date) < strtotime(date('Y-m-d'))) {
			exit('Checkin Date Error');
		}

		//clear cart
		if (NULL != $this->input->get('time')) {
			$this->session->unset_userdata('user_cart');
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
					$arr['rooms'][$r->id]['included'] 	= $r->included;
					$arr['rooms'][$r->id]['max_capacity']= $r->max_capacity;
					$arr['rooms'][$r->id]['max_adult']	= $r->max_adult;
					$arr['rooms'][$r->id]['max_child']	= $r->max_child;
					$arr['rooms'][$r->id]['default_policy']	= $r->default_policy;
					$arr['rooms'][$r->id]['photos'] 	= $this->front_model->get_room_photos($r->id);
					
					//check if price is set for the day
					if ($this->front_model->get_bar_by_room($d,$r->id)) {
						$arr['rooms'][$r->id]['prices'][$d] = $this->front_model->get_bar_by_room($d,$r->id);
					}else{
						$arr['rooms'][$r->id]['prices'][$d]['available'] = 0;
						$arr['rooms'][$r->id]['prices'][$d]['stoped_arrival'] = 1;
						$arr['rooms'][$r->id]['prices'][$d]['stoped_departure'] = 1;
						$arr['rooms'][$r->id]['prices'][$d]['base_price'] = 0;
						$arr['rooms'][$r->id]['prices'][$d]['single_price'] = 0;
						$arr['rooms'][$r->id]['prices'][$d]['double_price'] = 0;
						$arr['rooms'][$r->id]['prices'][$d]['triple_price'] = 0;
						$arr['rooms'][$r->id]['prices'][$d]['extra_adult'] = 0;
					}

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
		}else{
			$arr['promotions'] = [];
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

		$this->session->set_userdata('options',$data['options']);

		$data['hotel_info'] 	= $hotel;
		$data['hotel_photos']	= $this->front_model->get_hotel_photos($hotel_id);
		//$data['rooms'] 			= array_orderby($arr['rooms'],'single_price',SORT_ASC);
		$data['rooms'] 			= $arr['rooms'];


		//create prices and set session 
		//by rooms and promotions
		$this->calculate_room_prices($data['rooms']);
		if (is_array($arr['promotions'])) {
			$this->calculate_promo_prices($arr['promotions']);
			//set promotion rules
			$data['promotion']		= $this->set_promotion_rules($arr['promotions']);
		}else{
			$data['promotion']		= false;
		}


		//Extras
		$data['extras']			= $this->front_model->get_extras($hotel_id,$default_lang);
		$this->calculate_extra_prices($data['extras']);
				
		$data['prices'] 		= $this->session->userdata('prices_all');
		$data['user_cart'] 		= $this->session->userdata('user_cart');
		$data['user_extras'] 	= $this->session->userdata('user_extras');
		$data['guest']			= $this->session->userdata('guest');
		echo '<!--';
		echo '<pre>';
		print_r($data);
		echo '-->';
		

		$this->load->view('front/index',$data);

	}

	/*
	* Reservation Detail Page.
	*
	*/
	public function reservation(){
		$my_session  = $this->session->userdata('my_session_id');

		//echo 'Hash : '.$this->input->get('hash').'<br>';
		//echo 'Sess : '.$my_session.'<br>';

		if (!$this->input->get('hash')) {
			echo 'No Hash';
		}

		if (!$this->input->get('code')) {
			echo 'No Reservation';
		}

		$this->load->helper('room_helper');

		$res_id = $this->input->get('code');

		//get reservationm details
		$reservation = $this->front_model->get_reservation_details($res_id);

		//get hotel details
		$hotel		 = $this->front_model->hotel_info($reservation->hotel_id);

		//rooms details
		$rooms = json_decode($reservation->rooms,TRUE);

		
		$total_room = 0;
		//echo '<pre>'; print_r($rooms); echo '</pre>'; 
		foreach ($rooms as $r => $room) {

			$room_id = explode('-', $r);
			$room_id = $room['room_id'];

			@$rooms['booked'][$room_id]['info'] = $room;
			$rooms['booked'][$room_id]['details'] = $this->front_model->get_room_details($room_id);
			$rooms['booked'][$room_id]['photos'] = $this->front_model->get_room_photos($room_id);
			$total_room += $room['qty'];

			unset($rooms[$r]);
		}
		//echo '<pre>'; print_r($rooms); echo '</pre>';

		$rooms['total_room'] = $total_room;

		//generate data to send view
		$data['reservation'] 	= $reservation;
		$data['rooms'] 			= $rooms;
		$data['hotel']			= $hotel;

		/*
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		*/
		$this->load->view('front/reservation',$data);
	}

	//add to cart başlasın
	//burayı düzgünce yapmak lazım
	public function user_cart(){
		
		$options = $this->session->userdata('options');
		
		$user_cart = $this->session->userdata('user_cart');
		$room_id 	= $this->input->post('room');
		$policy 	= $this->input->post('policy');
		$qty 		= $this->input->post('qty');
		$promotion 	= $this->input->post('promotion');
		$rate 		= $this->input->post('rate');
		$currency 	= $this->input->post('currency');
		$default_currency = $this->input->post('default_currency');
		$room_prices = $this->session->userdata('prices_all');

		//print_r($room_prices);
		//exit;

		$action  	= $this->input->post('type');
		if ($action == 'delete') {
			foreach ($user_cart as $key => $c) {
				if ($c['room_id'] == $room_id and $c['promotion'] == $promotion and isset($user_cart[$key])) {
					unset($user_cart[$key]);
				}
			} 
			
		//add item
		}else{

			/*
			foreach ($user_cart as $key => $c) {
				if ($c['room_id'] == $room_id and $c['promotion'] == $promotion) {
					unset($user_cart[$key]);
				}
			}*/

			if ($promotion != 0) {
				$price = $room_prices->$room_id->promotions->$promotion->price;
			}else{
				$price = $room_prices->$room_id->price;
			}

			$arr =  array('room_id'=>$room_id, 
				'qty'=>$qty,
				'policy'=>$policy,
				'promotion'=>$promotion,
				'price'=>$price,
				'user_price'=>show_price($price,$rate),
				'name' => $this->input->post('name'),
				'desc' => $this->input->post('desc'));
			$user_cart[] = $arr;
		}
		//$user_cart = '';
		$this->session->set_userdata('user_cart',$user_cart);
		
		//get total items in cart
		$response['action'] = $action;
		$response['total_price'] = 0;
		$response['user_price'] = 0;
		$response['total_qty'] = 0;
		$response['currency'] = $currency;
		$response['currency_rate'] = $rate;
		$response['default_currency'] = $default_currency;

		foreach ($user_cart as $r => $v) {
			$response['user_price']  	+= show_price($v['price']*$v['qty'],$rate);
			$response['total_price']  	+= $v['price']*$v['qty'];
			$response['total_qty'] 		+= $v['qty'];
		}

		$response['details'] = $user_cart;

		echo json_encode($response);
	}

	function user_extras(){
		$prices 		= $this->session->userdata('prices_all');

		$extra_id 		= $this->input->post('extra_id');
		$extra_name		= $this->input->post('extra_name');
		$currency 		= $this->input->post('currency');
		$user_currency 	= $this->input->post('user_currency');
		$currency_rate 	= $this->input->post('currency_rate');
		$user_currency 	= $this->input->post('user_currency');
		$price 			= $prices->extras->$extra_id->price;
		$type 			= $this->input->get('type');
		$extra 			= $this->input->post('extra');

		if (!$extra) {
			echo json_encode(array('status'=>'error'));
			exit;
		}

		$user_extras = $this->session->userdata('user_extras');

		$extra_details = '';
		foreach ($extra as $key => $e) {
			$extra_details = $e;
		}
			
		//$user_extras = array();
		if ($type == 'add') {
			$user_extras[$extra_id] = array('name'=>$extra_name,'price'	=> $price,'details'=>$extra_details);

			$this->session->set_userdata('user_extras',$user_extras);
		}else{
			unset($user_extras[$extra_id]);
			$this->session->set_userdata('user_extras',$user_extras);
		}

		//get total items in cart
		$response['status'] = 'success';
		$response['extra_id'] = $extra_id;
		$response['action'] = $type;
		$response['total_price'] = 0;
		$response['user_price'] = 0;
		$response['currency'] = $currency;
		$response['currency_rate'] = $currency_rate;
		$response['user_currency'] = $user_currency;

		foreach ($user_extras as $key => $extra) {
			$response['user_price']  	+= show_price($extra['price'],$currency_rate);
			$response['total_price']  	+= $extra['price'];
		}

		$response['details'] = $user_extras;
		echo json_encode($response);
	}

	function check_reservation(){

		$code 		= $this->input->post('code');
		$pincode 	= $this->input->post('pincode');
		$hotel_id 	= $this->input->post('hotel_id');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('code', 'Reservation Id', 'required');
		$this->form_validation->set_rules('pincode', 'Pincode', 'required');

		$this->output->set_content_type('application/json');

		if ($this->form_validation->run() == FALSE){
			echo json_encode(array('status' =>'error','message'=> validation_errors()));
		}else{

			$check = $this->front_model->reservation_login($code,$pincode,$hotel_id);
			if (!$check) {
				echo json_encode(array('status' =>'error','message'=> 'No Reservation Found, Please check your pincode.'));
			}else{
				$guest_data = array(
					'guest_name' => $check->first_name, 
					'guest_surname'=>$check->last_name, 
					'hash'=>$check->rhash,
					'res_id' => $check->id,
					'res_code' => $check->reservation_code);

				$this->session->set_userdata('guest',$guest_data);

				echo json_encode(array('status' =>'success',
					'hash'=> $check->rhash,
					'code'=> $check->id,
					'sess'=> $this->session->userdata('my_session_id')));
			}
		}


	}

	/*
	* Print Currency Rates JSON
	* DEPRECATED
	* Currency Function used in General Helper
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

	public function clear_session(){
		$this->session->unset_userdata('guest');
	}
	

}
