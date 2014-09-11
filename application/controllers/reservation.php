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

		$uri = $this->uri->segment('3');

		$this->load->helper('specs');
		
		if ($uri=='add_new') {

			$data['countries'] = $this->reservation_model->countries();

			$this->load->view('reservation/hotels_add',$data);

		}elseif($uri=='edit'){

			$id = $this->uri->segment('4');

			//get hotel detail
			$data['hotel'] 		 = $this->reservation_model->hotel_details($id);
			$data['description'] = $this->reservation_model->hotel_description($data['hotel']->id);
			$data['countries'] = $this->reservation_model->countries();

			$this->load->view('reservation/hotels_edit',$data);

		}else{

			$this->load->view('reservation/hotels');
		}
		
	}
	
}
