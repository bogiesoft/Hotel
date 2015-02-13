<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('general_helper');
		$this->load->model('front_model');
	}

	function index(){
		$hotel_id = $this->input->get('hotel_id');

		//if hotel id is not set return error
		if (!$hotel_id) {
			exit('Error');
		}

		$default_lang = $this->session->userdata('default_lang') ? $this->session->userdata('default_lang') : 'de';

		$start_date = $this->input->get('checkin') ? $this->input->get('checkin') : date('Y-m-d');
		$end_date 	= $this->input->get('checkout') ? $this->input->get('checkout') : date('Y-m-d');
		$adults		= $this->input->get('adults') ? $this->input->get('adults') : '1';
		$children	= $this->input->get('child') ? $this->input->get('child') : '0';

		//get hotel info
		$hotel = $this->front_model->hotel_info($hotel_id);

		//get rooms
		$search = array('child' => $children,
			'adults' => $adults,
			'language' => $default_lang);


		$rooms = $this->front_model->get_hotel_rooms($hotel_id,$search);

		$arr = array();
		foreach (date_range($start_date,$end_date) as $k => $d) {

			$arr['dates'][$d] = $d;
		
			foreach ($rooms as $key => $r) {
				$arr['rooms'][$r->id]['name'] 		= $r->name;
				$arr['rooms'][$r->id]['title'] 		= $r->title;
				$arr['rooms'][$r->id]['content'] 	= $r->content;
				$arr['rooms'][$r->id]['photos'] 	= $this->front_model->get_room_photos($r->id);
				$arr['rooms'][$r->id]['prices'][$d] = $this->front_model->get_bar_by_room($d,$r->id);
				$arr['rooms'][$r->id]['prices'][$d]['room_name'] = $r->name;
				$arr['rooms'][$r->id]['prices'][$d]['room_id'] = $r->id;
				$arr['rooms'][$r->id]['prices'][$d]['room_capacity'] = $r->capacity;
				$arr['rooms'][$r->id]['prices'][$d]['room_child'] = $r->min_child;
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



		$data['hotel_info'] = $hotel;
		$data['rooms'] = $rooms;


		echo '<pre>';
		print_r($arr);

	}

}
