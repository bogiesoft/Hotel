<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct(){
		parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			redirect(site_url('login'));
		}
		$this->load->helper('general_helper');
		
	}

	public function index(){
		//echo $this->session->userdata('user_id');
		$this->load->model('dashboard_model');

		//set reservation stats
		$today 			= date('Y-m-d');
		$last_week 		= date('Y-m-d',strtotime("-7 DAY",strtotime($today)));
		$last_month 	= date('Y-m-d',strtotime("-30 DAY",strtotime($today)));

		$stats			= $this->dashboard_model->reservation_stats($today,$last_month);

		/*
		* Calculate reservation counts
		*/
		//todays reservation  count
		$reservations = array();
		$reservations['today']	= $stats[$today]['total'];

		//last week reservation count
		$reservations['last_week'] = 0;
		foreach ($stats as $date => $value) {
			if ($date >= $last_week) {
				$reservations['last_week'] = $reservations['last_week'] + $value['total']; 
			}
		}

		//last month reservation count
		$reservations['last_month'] = 0;
		foreach ($stats as $date => $value) {
			$reservations['last_month'] = $reservations['last_month'] + $value['total']; 		
		}

		/*
		* Calculate prices counts
		*/
		$prices = array();
		$prices['today']	= $stats[$today]['total_price'];

		//last week reservation count
		$prices['last_week'] = 0;
		foreach ($stats as $date => $value) {
			if ($date >= $last_week) {
				$prices['last_week'] = $prices['last_week'] + $value['total_price']; 
			}
		}

		//last month reservation count
		$prices['last_month'] = 0;
		foreach ($stats as $date => $value) {
			$prices['last_month'] = $prices['last_month'] + $value['total_price']; 		
		}

		//set default stats
		foreach ($stats as $key => $value) {
			 $chart[] = $value;
		}

		$data['stats']				= $chart;
		$data['reservation_stats']	= $reservations;
		$data['price_stats']		= $prices;
		//$data['hotel_currency']		= $prices;
		$data['events'] 			= $this->dashboard_model->calendar_events();

		$this->load->view('dashboard',$data);

	}

	function set_hotel(){
		$id 		= $this->input->get('id');
		$redirect 	= $this->input->get('redirect');

		$hotel = $this->db->query("SELECT id,name FROM hotels where id ='$id'")->row();

		$user_data =  array(
					'hotel_id'  => $hotel->id,
					'hotel_name'=> $hotel->name);

		$this->session->set_userdata($user_data);

		redirect(site_url($redirect));
	}
	
}
