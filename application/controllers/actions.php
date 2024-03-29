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
	* Generate room preferences forms comes from ajax
	*/

	function room_preferences_builder(){
		if(!$this->input->is_ajax_request())
		    exit('Opps.Trying to hack. What a brave!');

		$data = $this->input->post('data');
		//print_r($data);exit;
		$options = array('id'=>$this->input->post('room_id'),
			'name'	 => 'pref',
			'button' => false);

		echo  form_builder(json_encode($data),$options);
	}

	/*
	* Draw Chart
	*/
	function room_price_info(){
		//print_r($this->input->post('children')); exit;
		$room_id = $this->input->post('room_id');
		$options = json_decode($this->input->post('options'),true);
		$start = $options['checkin'];
		$adults = $options['adults'];
		$rate  = $options['currency_rate'];
		$discount = $this->input->post('discount');
		$child_ages = json_decode($this->input->post('children'));
		//get prices for 7 days
		$prices = $this->front_model->get_room_price_for_chart($start,$room_id);


		if ($adults == 1) {
			$type = 'single_price';
		}elseif($adults == 2){
			$type = 'double_price';
		}elseif($adults >= 3){
			$type = 'triple_price';
		}

		$data = array();
		foreach ($prices as $key => $p) {
			$total_child_price = 0;
			$adult_price  = 0;

			//if price is unit price
			if (isset($p['price_type']) and $p['price_type'] == 1) {
				$adult_price += $p['base_price'];
			}else{
				//if adults more than 3
				if ($this->adults >= 4) {
					$total_adult = $this->adults - 3;
					$total_adult_price = $total_adult * $p['extra_adult'];
					$adult_price += $p['triple_price'];
					$adult_price += $total_adult_price;

				}else{
					$adult_price += $p[$type];
				}
			}

			//calculate children prices
			if ($options['children'] !=0 and isset($p['child_price']) and count($child_ages)>0) {
				
				$child_price = json_decode($p['child_price'],true);
				//print_r($child_price);
				foreach ($child_ages as $key => $age) {
					$total_child_price += $this->get_child_price_by_age($age,$child_price);
				}

			}

			$total_price =  $adult_price + $total_child_price;

			$data[$p['price_date']]['date'] = $p['price_date'];

			$price = $total_price - ($total_price * $discount / 100);

			$data[$p['price_date']]['price'] = show_price($price,$rate);
		}


		//chart json data
		$chart_detail = '';
		$chart_data = array();
		foreach ($data as $date => $value) {
			$day = date('l',strtotime($date));
			$dayNum = date('d',strtotime($date));

			$class = ($day == 'Sunday' or $day == 'Saturday') ? 'weekend' : '';
			$class .= ($date == date('Y-m-d')) ? 'today' : '';
			

			$price = $value['price'];
			$ymd = date('Y-m-d',strtotime($date));

			$chart_data[$ymd] = array('dayAbr'=>substr($day,0,1), 
				'dayNum' => $dayNum,
				'date'	=> date('M d',strtotime($date)),
				'ymd'	=> $ymd,
				'price' => $price, 
				'cclass' => $class
				);

		}
		

		$start_date = $options['checkin'];
		$date_range = date_range($start_date, date('Y-m-d',strtotime('+30 day',strtotime($start_date))));

		
		$chart = array();

		foreach ($date_range as $key => $date) {
			$day = date('l',strtotime($date));
			$dayNum = date('d',strtotime($date));
			$class = ($day == 'Sunday' or $day == 'Saturday') ? 'weekend' : '';
			$class .= ($date == date('Y-m-d')) ? 'today' : '';
				
			if (!isset($chart_data[$date])) {
				$chart[] = array('dayAbr'=>substr($day,0,1), 
				'dayNum' => $dayNum,
				'date'	=> date('M d',strtotime($date)),
				'price' => 0,
				'cclass' => $class
				);

			}else{
				$chart[] = array('dayAbr'=>substr($day,0,1), 
				'dayNum' => $dayNum,
				'date'	=> date('M d',strtotime($date)),
				'price' => $chart_data[$date]['price'],
				'cclass' => $class
				);

			}

		}
		
		echo json_encode($chart);


		//google chart için datayuı şekillendir
		/*

		$rows = array();
		foreach ($data as $key => $value) {
			$cell0["v"]=date('D-m-Y',strtotime($value['date']));
			//$cell0["v"]=substr($cell0["v"], 0,-2);
			$cell1["v"]=$value['price'];
			$row["c"]=array($cell0,$cell1);
 	
 			array_push($rows,$row);
			//$a['rows']['c'][] = array('v'=>array($value['date'])),array('v'=>array($value['price']));
		}


		$a['cols'] = array(array('label'=>'Day','type'=>'string'),array('label'=>'Price','type'=>'number'));
    	$a['rows'] = $rows;
		
		echo json_encode($a);
		*/
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
        	$data['status'] = 1;
        	//if reservation changes
			$res_code = $this->session->userdata('res_code');

        	$pincode = mt_rand(1000,9999);

        	if ($res_code) {
        		$data['reservation_code']=$res_code;
        		$data['status'] = 2;
        	}else{
        		$data['reservation_code']= rand_uniqid((int)$this->input->post('phone').$pincode); //cuz, phone numbers is kinda unique :p, last 4 chars come random
        	}

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
        	$data['mobile'] 		= $this->input->post('mobile');
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

	        	if (!empty($user_extras)) {
	        		foreach ($user_extras as $key => $cart) {
	        			$extra_price += $cart['price'];
	        		}
	        	}
	        	

	        $data['extras']			= json_encode($user_extras);
        	$data['extras_price']	= $extra_price;
        	$data['total_price']	= $room_price+$extra_price;
        	//print_r($room_details);

        	
			$data['rhash'] = $this->session->userdata('my_session_id');			
        		
			
			if ($res_code) {

				//TODO buraya reservation history yapılacak,sadece tek satır update edilmyecek
				$insert = $this->db->update('reservations',$data,
					array('reservation_code'=>$res_code,'hotel_id'=> $data['hotel_id']));

				$data['res_id'] = $this->front_model->get_reservation_id($res_code,$data['hotel_id']);

			}else{ //else insert new resevation

				$insert = $this->db->insert('reservations',$data);
        		$data['res_id'] = $this->db->insert_id();

        		//change available days
        		$this->change_availablity($data['rooms'],$data['checkin'],$data['checkout']);
			}
        	
			$data['id']	= $data['res_id'];


			$data['ip'] = $this->input->ip_address();

        	//$insert = true;
        	if ($insert) {
        		echo json_encode(array('status'=>'success','data'=>$data));


        		//send mail
        		$data['hotel_info'] = $this->front_model->hotel_info($data['hotel_id']);
        		$data['reservation_date'] = date('Y-m-d H:i:s');
        		//send mail
        		$this->send_information_mail($data,$res_code);
        		//send mail to hotel
        		$this->send_information_mail_to_hotel($data,$res_code);
        		
        		//send sms
        		if ($this->input->post('sendsms')) {
        			$this->send_information_sms($data,$res_code);
        		}
        		
        	}else{
        		echo json_encode(array('status'=>'error','errors'=>'Database Error'));
        	}
            
        }


	}

	function send_information_mail($data,$res_code=false){
		//send mail to user
		$this->lang->load('reservation/policies','en');
		$this->lang->load('reservation/mail','en');

		if ($res_code) {
			$subject = 'Modified Reservation - '.$res_code;
		}else{
			$subject = 'New Reservation - '.$data['reservation_code'];
		}

		//if cancelled
		if (isset($data['status']) and $data['status'] == 0) {
			$subject = 'Cancelled Reservation - '.$data['reservation_code'];
		}

		$user_mail = $data['email'];

		    $config = array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.mandrillapp.com',
			  'smtp_port' => 587,
			  'smtp_user' => 'selam@bencagri.com', 
			  'smtp_pass' => '9V3ej0F71DJJiMyPse1g_g', 
			  'mailtype' => 'html',
			  'charset' => 'UTF-8',
			  'wordwrap' => TRUE);

			$message = $this->load->view('mail/user1',$data,TRUE);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($data['hotel_info']->email); 
			$this->email->to($user_mail);
			$this->email->subject($subject);
			$this->email->message($message);


			$this->email->send();

	}

	function send_information_mail_to_hotel($data,$res_code=false){
		//send mail to user
		$this->lang->load('reservation/policies','en');
		$this->lang->load('reservation/mail','en');

		if ($res_code) {
			$subject = 'Modified Reservation - '.$res_code;
		}else{
			$subject = 'New Reservation'.$data['reservation_code'];
		}

		//if cancelled
		if (isset($data['status']) and $data['status'] == 0) {
			$subject = 'Cancelled Reservation - '.$data['reservation_code'];
		}

		$user_mail = $data['hotel_info']->email;

		    $config = array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.mandrillapp.com',
			  'smtp_port' => 587,
			  'smtp_user' => 'selam@bencagri.com', 
			  'smtp_pass' => '9V3ej0F71DJJiMyPse1g_g', 
			  'mailtype' => 'html',
			  'charset' => 'UTF-8',
			  'wordwrap' => TRUE);

			$message = $this->load->view('mail/hotel',$data,TRUE);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from('info@rabooking.com'); 
			$this->email->to($user_mail);
			$this->email->subject($subject);
			$this->email->message($message);


			$this->email->send();

	}


	/*
	* Send Sms
	*/
	function send_information_sms($data,$res_code){

		$hotel_name = url_slug($data['hotel_info']->name);
		$res_code  = $data['reservation_code'];
		$pincode  = $data['pincode'];
		$from = $data['checkin'];
		$to  = $data['checkout'];
		$price = $data['total_price'];
		$currency = $data['hotel_info']->currency;

		$msj = $hotel_name."\n"."Reservation Code:".$res_code."\n"."Pincode:".$pincode."\n"."From:".$from."\n"."To:".$to."\n"."Total:".$price.$currency."\n";

		$msj = urlencode($msj);
		
		$user = "metinkoca";
		$password = "eZWdaZaOJDcVNG";
		$api_id = "3545801";
		$baseurl ="http://api.clickatell.com";

		//$text = urlencode("This is an example message");
		$text = $msj;
		//$to = "00123456789";
		$to = $data['mobile'];

		// auth call
		$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";

		// do auth call
		$ret = file($url);

		// explode our response. return string is on first line of the data returned
		$sess = explode(":",$ret[0]);
		if ($sess[0] == "OK") {

		    $sess_id = trim($sess[1]); // remove any whitespace
		    $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";

		    // do sendmsg call
		    $ret = file($url);
		    $send = explode(":",$ret[0]);

		    if ($send[0] == "ID") {
		        return true;
		    } else {
		        return false;
		    }
		} else {
		    return false;
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

	/*
	*Confirmation Check
	*/
	function confirmation_check(){
		if (isset($_POST['confirmation'])) return true;
	    $this->form_validation->set_message('confirmation_check', 'Please read and accept our terms and conditions.');
	    return false;
	}

	/*
	* Update country phone code
	* Used in front country select on change (Ajax)
	*/
	function get_country_code(){
		$code = $this->input->post('code');

		$response = array('code'=>$this->front_model->get_country_phone_code($code));
		echo json_encode($response);
	}

	function get_reservation_detail(){
		$result = $this->front_model->get_reservation_detail($this->input->get('id'));
		echo json_encode(array('status' => 'ok', 'data' => $result ));
	}


	function cancel_reservation(){
		$id = $this->input->post('id');
		$code = $this->input->post('code');

		$cancel = $this->front_model->cancel_reservation($id,$code);

		if ($cancel) {
			//Send cancallation mail
			$data = $this->front_model->get_reservation_by_id($id);
			$data['hotel_info'] = $this->front_model->hotel_info($data['hotel_id']);
			$this->send_information_mail($data);

			echo json_encode(array('status'=>'success'));



		}else{
			echo json_encode(array('status'=>'error'));
		}

	}
}