<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends STAFF_Controller {

	function __construct(){
		parent::__construct();

		/* TODO */
		/* ip control yapılacak */
		
		$this->load->model('staff_model');

	}

	function index(){
		$this->load->view('staff/index');

		
	}

	function hotels(){
		if ($this->uri->segment('3') == 'get_hotels') {

			$result = array();
			$result['Result'] = "OK";
			$result['TotalRecordCount'] = '100';
			$result['Records'] = $this->staff_model->get_hotels();
			print json_encode($result);
		}else{
			$this->load->view('staff/hotels');
		}
		

		
	}

	function hotel_edit($id = NULL){

		if (NULL == $id) {
			echo 'url\'yi değiştirme';
			exit;
		}

		$hotel = $this->staff_model->hotel_detail($id);

		if (!$hotel) {
			echo 'otel bulunamadı';
			exit;
		}	



		$data['hotel'] = $hotel;

		
		$this->load->helper('general');
		$this->load->view('staff/hotel_edit',$data);
	}

	function users(){

	}
}