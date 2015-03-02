<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {

	var $total_room_price;
	var $user_cart;
	var $adults = 1;
	var $children = 0;
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
		$default_lang = $this->session->userdata('default_lang') ? $this->session->userdata('default_lang') : 'en';
		$start_date = $this->input->get('checkin') ? $this->input->get('checkin') : date('d-m-Y');
		$end_date 	= $this->input->get('checkout') ? $this->input->get('checkout') : date('d-m-Y');
		$adults		= $this->input->get('adults') ? $this->input->get('adults') : '1';
		$children	= $this->input->get('children') ? $this->input->get('children') : '0';
		$nights 	= 1;

		$this->adults = $adults;
		$this->children = $children;

		//make dates to yy-mm-dd format
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));

		//salaklar start date'i end date'den sonrası bir tarihe girerse falan
		if (strtotime($start_date) > strtotime($end_date)) {
			exit('Checkout Date Error');
		}

		//salaklar geçmişe dönük rezervasyon yapmak isterse
		if (strtotime($start_date) < strtotime(date('Y-m-d'))) {
			exit('Checkin Date Error');
		}

		//load languages
		$this->lang->load('reservation/rooms',$default_lang);


		//get rooms
		$search = array('child' => $children,
			'adults' => $adults,
			'language' => $default_lang);

		$arr = array();
		$rooms = $this->front_model->get_hotel_rooms($hotel_id,$search);

		if (FALSE === $rooms) {
			$arr['rooms'] = '';
		}else{
			
			foreach (date_range($start_date,$end_date) as $k => $d) {

				$arr['dates'][$d] = $d;
				//set nights
				$nights = count($arr['dates']);
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
					
				}
			}

			$arr['promotions'] 	= $promotion;
		}

		$data['options'] 		= array(
			'nights' => $nights,
			'adults'=>$this->adults,
			'children'=>$this->children,
			'checkin'=>$start_date,
			'checkout'=>$end_date);


	

		$data['hotel_info'] 	= $hotel;
		$data['rooms'] 			= $arr['rooms'];
		$data['promotion'] 		= $arr['promotions'];
		;
		$data['room_price'] 	= $this->calculate_room_prices($data['rooms']);
		echo '<!--';
		echo '<pre>';
		print_r($data);
		echo '-->';
		

		$this->load->view('front/index',$data);

	}


	private function calculate_room_prices($arr){

		$this->total_room_price = new StdClass;

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
		foreach ($arr as $room_id => $r) {
			
			$total_child_price = 0;

			foreach ($r['prices'] as $date => $p) {

				//if price is unit price
				if (isset($p['price_type']) and $p['price_type'] == 1) {
					@$total_room_price->$room_id = $p['base_price'];
				}else{
					@$total_room_price->$room_id += $p[$type];
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

			$total_room_price->$room_id += $total_child_price;
			//$this->total_room_price->$room_id = number_format($this->total_room_price->$room_id, 2, '.', '');
		}

		$this->session->set_userdata('room_prices',$total_room_price);
		//print_r($this->session->userdata('room_prices'));
		return $total_room_price;
		//echo $total_child_price;
		//print_r($this->total_room_price);
	}

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

	//add to cart başlasın
	function user_cart(){
		
		$user_cart = $this->session->userdata('user_cart');

		$room_id 	= $this->input->post('room');
		$qty 		= $this->input->post('qty');
		$promotion 	= $this->input->post('promotion');

		$room_prices = $this->session->userdata('room_prices');

		if ($this->input->post('type') == 'delete' and $user_cart[$room_id]) {
			unset($user_cart[$room_id]);
		}else{
			$arr =  array('qty' => $qty,'promotion'=>$promotion,'price'=>$room_prices->$room_id );
			$user_cart[$room_id] = $arr;
		}

		$this->session->set_userdata('user_cart',$user_cart);
		
		//get total items in cart
		$response['total_price'] = 0;
		$response['total_qty'] = 0;

		


		foreach ($this->session->userdata('user_cart') as $r => $v) {
			$response['total_price']  	+= $v['price']*$v['qty'];
			$response['total_qty'] 		+= $v['qty'];
		}

		echo json_encode($response);
		//print_r($user_cart); exit;
		//print_r($this->session->userdata);
	}
}
