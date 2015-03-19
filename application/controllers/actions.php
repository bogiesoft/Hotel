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
		/*
		print_r($this->session->userdata('user_cart'));
		print_r($this->session->userdata('user_extras'));
		print_r($_POST);
		*/

		$this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('street_1', 'Address Line', 'required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('ccholder_name', 'Credit Card Holder Name', 'required');
        $this->form_validation->set_rules('ccnumber', 'Credit Card Number', 'callback_ccnumber_check');
        $this->form_validation->set_rules('ccmonth', 'Credit Card Month', 'required');
        $this->form_validation->set_rules('ccyear', 'Credit Card  Year', 'required');
        $this->form_validation->set_rules('cccvv', 'Credit Card CCV', 'required');

        if ($this->form_validation->run() == FALSE)
        {
        	$data = array(
                'first_name' => form_error('first_name'),
                'last_name' => form_error('last_name'),
                'street_1' => form_error('street_1'),
                'zipcode' => form_error('zipcode'),
                'country' => form_error('country'),
                'email' => form_error('email'),
                'ccholder_name' => form_error('ccholder_name'),
                'ccnumber' => form_error('ccnumber'),
                'ccmonth' => form_error('ccmonth'),
                'ccyear' => form_error('ccyear'),
                'cccvv' => form_error('cccvv'),
            );
        	echo json_encode(array('status'=>'error','errors'=>$data));
            //echo validation_errors('<1>','</1>');
        }
        else
        {
            echo json_encode(array('status'=>'success'));
        }


	}


	/*
	* Credit Card Luhn algorithm
	*/
	function ccnumber_check($str){

		$this->load->helper('creditcard_helper');

		if (card_number_valid($str)) {
	        return true; // non-digit found
		}else{
			$this->form_validation->set_message('ccnumber_check', 'The Credit Card is not valid');
			return false;
		}
	}


}