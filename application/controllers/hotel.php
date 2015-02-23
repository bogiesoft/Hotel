<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('general_helper');
		$this->load->helper('room_helper');
		$this->load->model('front_model');
	}

	function index(){

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
		$children	= $this->input->get('child') ? $this->input->get('child') : '0';
		$nights 	= 1;
		
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
			'adults'=>$adults,
			'children'=>$children,
			'checkin'=>$start_date,
			'checkout'=>$end_date);

		$data['hotel_info'] 	= $hotel;
		$data['rooms'] 			= $arr['rooms'];
		$data['promotion'] 		= $arr['promotions'];
		echo '<!--';
		echo '<pre>';
		print_r($data);
		echo '-->';

		$this->load->view('front/index',$data);

	}

}
