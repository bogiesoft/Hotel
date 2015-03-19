<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends CI_Controller {


	function __construct(){
		parent::__construct();
		
		$this->load->helper('general_helper');
		$this->load->model('front_model');

	}

	function get_room_preferences(){
		$room_id = $this->input->post('room_id');

		$preferences =   $this->front_model->room_preferences($room_id);
		echo json_encode(json_decode($preferences->preferences));
	}

	/*
	* Generate room preferences forms
	*/

	function room_preferences_builder(){
		$data = $this->input->post('data');
		//print_r($data);exit;
		$options = array('id'=>$this->input->post('room_id'),
			'name'	 => 'preferences',
			'button' => false);

		echo  form_builder(json_encode($data),$options);
	}

	/*
	* Finish Booking Ajax
	*/
	function finish_reservation(){
		print_r($this->session->userdata('user_cart'));
		print_r($this->session->userdata('user_extras'));
		print_r($_POST);
	}

}