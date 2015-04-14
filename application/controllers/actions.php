<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends RA_Controller {


	function __construct(){
		parent::__construct();
		
		$this->load->helper('general_helper');
		$this->load->model('front_model');

	}

	function get_room_preferences(){
		if(!$this->input->is_ajax_request())
		    exit('Opps.Trying to hack. What a brave!');
		
		$room_id = $this->input->post('room_id');

		$preferences =   $this->front_model->room_preferences($room_id);
		echo json_encode(json_decode($preferences->preferences));
	}

	/*
	* Generate room preferences forms
	*/

	function room_preferences_builder(){
		if(!$this->input->is_ajax_request())
		    exit('Opps.Trying to hack. What a brave!');

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
		if(!$this->input->is_ajax_request())
		    exit('Opps.Trying to hack. What a brave!');

		$user_cart 		= $this->session->userdata('user_cart');
		$user_extras 	= $this->session->userdata('user_extras');


		if (!$user_cart or count($user_cart) < 1) {
			$error = array('no_room' => 'You did not select any room.');
			exit(json_encode(array('status'=>'error','errors'=>$error)));
		}


		$this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('confirmation', 'Terms of Service and Booking Conditions', 'callback_confirmation_check');
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
                'confirmation' => form_error('confirmation'),
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

        }else{
        	$pincode = mt_rand(1000,9999);
        	$data['reservation_code']= rand_uniqid($this->input->post('phone').$pincode); //cuz, phone numbers is kinda unique :p, last 4 chars come random
        	$data['pincode'] 		= $pincode;
        	$data['name_title'] 	= $this->input->post('name_title');
        	$data['first_name']		= $this->input->post('first_name');
        	$data['last_name'] 		= $this->input->post('last_name');
        	$data['checkin'] 		= $this->input->post('checkin');
        	$data['checkout'] 		= $this->input->post('checkout');
        	$data['street_1'] 		= $this->input->post('street_1');
        	$data['street_2'] 		= $this->input->post('street_2');
        	$data['zipcode'] 		= $this->input->post('zipcode');
        	$data['city'] 			= $this->input->post('city');
        	$data['country'] 		= $this->input->post('country');
        	$data['phone'] 			= $this->input->post('phone');
        	$data['email'] 			= $this->input->post('email');
        	$data['adults'] 		= $this->input->post('adults');
        	$data['children'] 		= $this->input->post('children');
        	$data['children_ages']	= $this->input->post('children_ages');
        	$data['nights'] 		= $this->input->post('nights');
        	$data['ccholder_name'] 	= $this->input->post('ccholder_name');
        	$data['ccnumber'] 		= rand_uniqid($this->input->post('ccnumber'));
        	$data['ccmonth'] 		= $this->input->post('ccmonth');
        	$data['ccyear'] 		= $this->input->post('ccyear');
        	$data['cccvv'] 			= $this->input->post('cccvv');
        	$data['currency'] 		= $this->input->post('currency');
        	$data['hotel_id'] 		= $this->input->post('hotel_id');
        	$data['code'] 			= $this->input->post('code');

        	$preferences = $this->input->post('preferences');
	        	//generate room details
	        	$room_details = array();
	        	foreach ($user_cart as $key => $cart) {
	        		$room_details[$cart['room_id'].'-'.$key] = $cart;
	        		//generate room preferences
	        		if (isset($preferences[$cart['room_id']])) {
	        			$room_details[$cart['room_id'].'-'.$key]['preferences'] = $preferences[$cart['room_id']];
	        		}
	        	}

	        	//calculate room prices
	        	$room_price = '';
	        	foreach ($user_cart as $key => $cart) {
	        		$room_price += $cart['price']*$cart['qty'];
	        	}

        	$data['rooms'] 			= json_encode($room_details);
        	$data['rooms_price'] 	= $room_price;

		       	//generate extra prices
	        	$extra_price = '';
	        	foreach ($user_extras as $key => $cart) {
	        		$extra_price += $cart['price'];
	        	}
	        $data['extras']			= json_encode($user_extras);
        	$data['extras_price']	= $extra_price;
        	$data['total_price']	= $room_price+$extra_price;
        	//print_r($room_details);

        	$insert = $this->db->insert('reservations',$data);
        	if ($insert) {
        		echo json_encode(array('status'=>'success','data'=>$data));
        	}else{
        		echo json_encode(array('status'=>'error','errors'=>'Database Error'));
        	}
            
        }


	}

	/*
	* Draw Chart
	*/
	function room_price_info(){
		
		$room_id = $this->input->post('room_id');
		$options = json_decode($this->input->post('options'),true);
		$start = $options['checkin'];

		echo $start;
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

	/*
	*Confirmation Check
	*/
	function confirmation_check(){
		if (isset($_POST['confirmation'])) return true;
	    $this->form_validation->set_message('confirmation_check', 'Please read and accept our terms and conditions.');
	    return false;
	}

}