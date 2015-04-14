<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends RA_Controller {

	var $total_room_price;
	var $user_cart;
	public $adults = 2;
	public $children = 0;
	public $nights = 1;
	public $start_date;
	public $end_date;
	private $currency = 'EUR';
	public $user_currency;
	public $currency_rate = 1;

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

		$this->session->set_userdata('options',$data['options']);

		$data['hotel_info'] 	= $hotel;
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
		$data['user_extras'] 		= $this->session->userdata('user_extras');
		echo '<!--';
		echo '<pre>';
		print_r($data);
		echo '-->';
		

		$this->load->view('front/index',$data);

	}




	//add to cart başlasın
	//burayı düzgünce yapmak lazım
	public function user_cart(){
		
		$options = $this->session->userdata('options');
		
		$user_cart = $this->session->userdata('user_cart');
		$room_id 	= $this->input->post('room');
		$qty 		= $this->input->post('qty');
		$promotion 	= $this->input->post('promotion');
		$rate 		= $this->input->post('rate');
		$currency 	= $this->input->post('currency');
		$default_currency = $this->input->post('default_currency');
		$room_prices = $this->session->userdata('prices_all');
		$action  	= $this->input->post('type');
		if ($action == 'delete') {
			foreach ($user_cart as $key => $c) {
				if ($c['room_id'] == $room_id and $c['promotion'] == $promotion) {
					unset($user_cart[$key]);
				}
			} 
			
		//add item
		}else{

			foreach ($user_cart as $key => $c) {
				if ($c['room_id'] == $room_id and $c['promotion'] == $promotion) {
					unset($user_cart[$key]);
				}
			} 

			if ($promotion != 0) {
				$price = $room_prices->$room_id->promotions->$promotion->price;
			}else{
				$price = $room_prices->$room_id->price;
			}

			$arr =  array('room_id'=>$room_id, 
				'qty'=>$qty,
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
			$response['user_price']  	+= show_price($v['price']*$v['qty']*$options['nights'],$rate);
			$response['total_price']  	+= $v['price']*$v['qty']*$options['nights'];
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
		$type 			= $this->input->post('type'.$extra_id);
		$extra 			= $this->input->post('extra');

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


	

}
