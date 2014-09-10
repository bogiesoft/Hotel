<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends MY_Controller {

	function __construct(){
		parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			redirect(site_url('login'));
		}
		
	}

	public function index(){
		$this->hotels();
	}

	function hotels(){

		$uri = $this->uri->segment('3');
		if ($uri=='add_new') {

			$this->load->view('reservation/hotels_add');

		}elseif($uri=='edit'){

			$id = $this->uri->segment('4');

			//load reservation model
			$this->load->model('reservation_model');
			//get hotel detail
			$data['hotel'] = $this->reservation_model->hotel_details($id);

			$this->load->view('reservation/hotels_edit',$data);

		}else{

			$this->load->view('reservation/hotels');
		}
		
	}
	
}
