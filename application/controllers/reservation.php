<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends MY_Controller {

	function __construct(){
		parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			redirect(site_url('login'));
		}


		//load reservation model
		$this->load->model('reservation_model');
		
	}

	public function index(){
		$this->hotels();
	}

	function hotels(){
		//load language
		$this->lang->load('reservation/hotels',$this->language);
		
		$uri = $this->uri->segment('3');

		$this->load->helper('specs');
		
		if ($uri=='add_new') {

			$data['countries'] = $this->reservation_model->countries();

			$this->load->view('reservation/hotels_add',$data);

		}elseif($uri=='edit'){

			$id = $this->uri->segment('4');

			//get hotel detail
			$data['hotel'] 		 = $this->reservation_model->hotel_details($id);
			$data['description'] = $this->reservation_model->hotel_description($id);
			$data['countries'] 	 = $this->reservation_model->countries();
			$data['photos']		 = $this->reservation_model->hotel_photos($id);

			$this->load->view('reservation/hotels_edit',$data);

		}else{

			$this->load->view('reservation/hotels');
		}
		
	}
	

	function rooms(){
		//load language
		$this->lang->load('reservation/rooms',$this->language);

		$uri = $this->uri->segment('3');

		$this->load->helper('room');
		if ($uri=='add_new') {

			$this->load->view('reservation/room_add');

		}elseif($uri=='edit'){
			$id = $this->uri->segment('4');

			//get hotel detail
			$data['room'] 		 = $this->reservation_model->room_details($id);
			$data['description'] = $this->reservation_model->room_description($id);
			$data['photos']		 = $this->reservation_model->room_photos($id);
			$data['children']	 = $this->reservation_model->room_children($id);
			$this->load->view('reservation/room_edit',$data);

		}else{

			$this->load->view('reservation/room_types');
		}

		
	}

	function extras(){
		//load language
		$this->lang->load('reservation/extras',$this->language);

		$uri = $this->uri->segment('3');

		$this->load->helper('room');
		if ($uri=='add_new') {

			$this->load->view('reservation/extras_add');

		}elseif($uri=='edit'){
			$id = $this->uri->segment('4');

			//get hotel detail
			$data['extra'] 		 = $this->reservation_model->extra_details($id);
			$data['description'] = $this->reservation_model->extra_description($id);
			$this->load->view('reservation/extras_edit',$data);

		}else{

			$this->load->view('reservation/extras');
		}

		
	}


	function seasons(){
		//load language
		$this->lang->load('reservation/seasons',$this->language);
		$this->load->view('reservation/seasons');
	}

	function prices(){
		//load language
		$this->lang->load('reservation/set_prices',$this->language);

		//load user agent
		$this->load->library('user_agent');

		//set max row for table
		$rowlimit = $this->agent->is_mobile() ? '5' : '14';

		//set start date
		if (empty($this->input->get('start_date'))) {
			$start_date = date('Y-m-d', strtotime('-1 day', time()));
		}else{
			$start_date	= $this->input->get('start_date');
		}

		//set end date
		if (empty($this->input->get('end_date'))) {
			$end_date = date('Y-m-d', strtotime('+'.$rowlimit.' day', time()));
		}else{
			$end_date	= $this->input->get('end_date');
		}

		$data['error'] = false;
		if (strtotime($start_date) > strtotime($end_date)) {
			$data['error'] = lang('date_error');
		}


		$rooms = $this->reservation_model->get_hotel_rooms();
		$arr = array();
		foreach (date_range($start_date,$end_date) as $k => $d) {

			$arr['dates'][$d] = $d;
		
			foreach ($rooms as $key => $r) {
				$arr['rooms'][$r->id]['name'] 		= $r->name;
				$arr['rooms'][$r->id]['prices'][$d] = $this->reservation_model->get_bar_by_room($d,$r->id);
				$arr['rooms'][$r->id]['prices'][$d]['room_name'] = $r->name;
				$arr['rooms'][$r->id]['prices'][$d]['room_id'] = $r->id;
				$arr['rooms'][$r->id]['prices'][$d]['room_capacity'] = $r->capacity;
				$arr['rooms'][$r->id]['prices'][$d]['room_child'] = $r->max_child;
			}
		}
		
		//get promotions
		$promotions = $this->reservation_model->get_promotions();

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

		//echo '<pre>'; print_r($arr); exit;

		$data['start_date'] = $start_date;
		$data['end_date']	= $end_date;
		$data['rowlimit']	= $rowlimit;
		$data['data'] 		= $arr;

		
		$this->load->view('reservation/prices',$data);
		
	}

	function set_prices(){
		//load language
		$this->lang->load('reservation/set_prices',$this->language);
		$this->load->helper('general_helper');
		$data['seasons'] = $this->reservation_model->get_hotel_seasons();
		$data['rooms']	 = $this->reservation_model->get_hotel_rooms();
		$this->load->view('reservation/prices_add',$data);
	}

	function price_plans(){
		//load language
		$this->lang->load('reservation/price_plans',$this->language);

		$uri = $this->uri->segment('3');

		if ($uri=='add_new') {
			$data['rooms']	 = $this->reservation_model->get_hotel_rooms();
			$this->load->view('reservation/price_plans_add',$data);

		}elseif($uri=='edit'){

			$id = $this->uri->segment('4');

			//get hotel detail
			$data['p'] 		 = $this->reservation_model->price_plan_detail($id);
			$data['rooms']	 = $this->reservation_model->get_hotel_rooms();
			$this->load->view('reservation/price_plans_edit',$data);

		}else{

			$this->load->view('reservation/price_plans');
		}
	}

	function policies(){
		//load language
		$this->lang->load('reservation/policies',$this->language);

		$uri = $this->uri->segment('3');
		$this->load->helper('policy');
		
		if ($uri=='add_new') {

			$this->load->view('reservation/policies_add');

		}elseif($uri=='edit'){
			$id = $this->uri->segment('4');
			$data['policy'] = $this->reservation_model->policy_detail($id);
			$this->load->view('reservation/policies_edit',$data);

		}else{
			$this->load->view('reservation/policies');
		}
	}


	function reservations(){
		//load language
		$this->lang->load('reservation/reservations',$this->language);
		//print_r($this->uri->segment('3'));exit;
		if ($this->uri->segment('3') == 'view') {
			$id = $this->uri->segment('4');
			$data['reservation'] = $this->reservation_model->reservation_info($id);
			$this->load->view('reservation/reservation_detail',$data);

		}else{
			$this->load->view('reservation/reservations');
		}

		
	}

}
