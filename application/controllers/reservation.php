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
			$data['description'] = $this->reservation_model->hotel_description($id);
			$data['countries'] 	 = $this->reservation_model->countries();

			$this->load->view('reservation/hotels_edit',$data);

		}else{

			$this->load->view('reservation/hotels');
		}
		
	}
	

	function rooms(){
		$uri = $this->uri->segment('3');

		$this->load->helper('room');
		if ($uri=='add_new') {

			$this->load->view('reservation/room_add');

		}elseif($uri=='edit'){
			$id = $this->uri->segment('4');

			//get hotel detail
			$data['room'] 		 = $this->reservation_model->room_details($id);
			$data['description'] = $this->reservation_model->room_description($id);
			$this->load->view('reservation/room_edit',$data);

		}else{

			$this->load->view('reservation/room_types');
		}

		
	}

	function extras(){
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

}
