<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_actions extends ADMIN_Controller {

	function list_hotels(){
		$code = $this->session->userdata('code');
		$query = $this->db->query("SELECT id,name FROM hotels WHERE code = '$code'");


		$result = array();
		$result['Result'] = "OK";
		$result['TotalRecordCount'] = $query->num_rows();
		$result['Records'] = $query->result();
		print json_encode($result);


		//print_r($query->result());
	}


	function save_hotel(){
		//load language
		$this->lang->load('reservation/hotels',$this->language);

		$code = $this->session->userdata('code');

		$arr = array(
		'name' 			=> $this->input->post('name'),
		'category' 		=> $this->input->post('category'),
		'adress' 		=> $this->input->post('adress'),
		'phone' 		=> $this->input->post('phone'),
		'phone2' 		=> $this->input->post('phone2'),
		'fax' 			=> $this->input->post('fax'),
		'email' 		=> $this->input->post('email'),
		'website'		=> $this->input->post('website'),
		'country' 		=> $this->input->post('country'),
		'city' 			=> $this->input->post('city'),
		'postcode' 		=> $this->input->post('postcode'),
		'currency' 		=> $this->input->post('currency'),
		'administrator' => $this->input->post('administrator'),
		'reception_phone'=> $this->input->post('reception_phone'),
		'reception_email'=> $this->input->post('reception_email'),
		'description'	=> $this->input->post('default_desc'),
		'hotel_specs'	=> null!==$this->input->post('hotel_specs') ? implode(',',$this->input->post('hotel_specs')) : '0',
		'restourant_specs'=> null!==$this->input->post('restourant_specs') ? implode(',',$this->input->post('restourant_specs')) :'0',
		'sport_specs'	=> null!==$this->input->post('sport_specs') ? implode(',',$this->input->post('sport_specs')) : '0',
		'bank_name1'	=> $this->input->post('bank_name1'),
		'bank_office1'	=> $this->input->post('bank_office1'),
		'bank_swift1'	=> $this->input->post('bank_swift1'),
		'bank_currency1'=> $this->input->post('bank_currency1'),
		'bank_account1'	=> $this->input->post('bank_account1'),
		'bank_beneficiary1'	=> $this->input->post('bank_beneficiary1'),
		'bank_iban1'	=> $this->input->post('bank_iban1'),
		'bank_name2'	=> $this->input->post('bank_name2'),
		'bank_office2'	=> $this->input->post('bank_office2'),
		'bank_swift2'	=> $this->input->post('bank_swift2'),
		'bank_currency2'=> $this->input->post('bank_currency2'),
		'bank_account2'	=> $this->input->post('bank_account2'),
		'bank_beneficiary2' => $this->input->post('bank_beneficiary2'),
		'bank_iban2'	=> $this->input->post('bank_iban2'),
		'hotel_logo'	=> $this->input->post('logo_image_value'),
		'code'			=> $code
		);

		//update mi yeni mi?
		if ($this->input->post('update') == 1) {
			$hotel_id = $this->input->post('hotel_id');

			$update = $this->db->update('hotels',$arr,array('id' => $hotel_id));
			//diğer dillerdeki açıklamalar
			$this->db->delete('hotel_contents',array('hotel_id'=>$hotel_id,'code'=>$code));
			$description	= $this->input->post('description');

			foreach ($description as $key => $value) {
				$this->db->insert('hotel_contents',array(
					'lang'		=>$value['lang'],
					'content'	=> $value['desc'],
					'hotel_id'	=> $hotel_id,
					'code'		=> $code));
			}

			if ($update) {
				$this->session->set_flashdata('success',lang('update_success'));
				redirect('reservation/hotels/edit/'.$hotel_id);
			}else{
				$this->session->set_flashdata('error',lang('update_error'));
				redirect('reservation/hotels/add_new');

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}


		}else{

			$insert = $this->db->insert('hotels',$arr);
			$hotel_id = $this->db->insert_id();

			//diğer dillerdeki açıklamalar
			$this->db->delete('hotel_contents',array('hotel_id'=>$hotel_id,'code'=>$code));
			$description	= $this->input->post('description');

			foreach ($description as $key => $value) {
				$this->db->insert('hotel_contents',array(
					'lang'		=>$value['lang'],
					'content'	=> $value['desc'],
					'hotel_id'	=> $hotel_id,
					'code'		=> $code));
			}

			if ($insert) {
				$this->session->set_flashdata('success',lang('added_success'));
				redirect('reservation/hotels/edit/'.$hotel_id);
			}else{
				$this->session->set_flashdata('error',lang('added_error'));
				redirect('reservation/hotels/add_new');

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}
		}
		

	}

	function list_rooms(){
		$hotel_id = $this->session->userdata('hotel_id');
		$query = $this->db->query("SELECT * FROM rooms WHERE hotel_id='$hotel_id'");

		$result = array();
		$result['Result'] = "OK";
		$result['TotalRecordCount'] = $query->num_rows();
		$result['Records'] = $query->result();
		print json_encode($result);
	}

	function save_room(){
		//load language
		$this->lang->load('reservation/hotels',$this->language);

		$code 		= $this->session->userdata('code');
		$hotel_id 	= $this->session->userdata('hotel_id');

		
		$arr = array(
			'name' 			=> $this->input->post('name'),
			'capacity' 		=> $this->input->post('capacity'),
			'min_capacity' 	=> $this->input->post('min_capacity'),
			'max_capacity' 	=> $this->input->post('max_capacity'),
			'min_adult' 	=> $this->input->post('min_adult'),
			'max_adult' 	=> $this->input->post('max_adult'),
			'max_child' 	=> $this->input->post('max_child'),
			'default_policy'=> $this->input->post('default_policy'),
			'room_units' 	=> null!==$this->input->post('room_units') ? implode(',',$this->input->post('room_units')) : '0',
			'preferences' 	=> empty($this->input->post('forms')) ? 0 : $this->input->post('forms'),
			'hotel_id'		=> $hotel_id,
			'code'			=> $code);

		//update mi yeni mi?
		if ($this->input->post('update') == 1) {
			$room_id = $this->input->post('room_id');

			$update = $this->db->update('rooms',$arr,array('id' => $room_id));
			

			//diğer dillerdeki açıklamalar
			$this->db->delete('room_contents',array('room_id'=>$room_id));
			$description	= $this->input->post('description');

			foreach ($description as $key => $value) {
				$this->db->insert('room_contents',array(
					'lang'		=> $value['lang'],
					'content'	=> $value['desc'],
					'title'		=> $value['title'],
					'room_id'	=> $room_id,
					'hotel_id'	=> $hotel_id));
			}

			//children yaşlarını ekle
			if ($arr['max_child'] != '0') {
				$this->db->delete('room_children',array('room_id'=> $room_id));
				$children = $this->input->post('child_age');

				foreach ($children as $key => $child) {
					$this->db->insert('room_children',array(
						'room_id' => $room_id,
						'child_id' => $key,
						'child_min' => $child['min'],
						'child_max'	=> $child['max']));
				}

			}
			

			if ($update) {
				$this->session->set_flashdata('success',lang('update_success'));
				redirect('reservation/rooms/edit/'.$room_id);
			}else{
				$this->session->set_flashdata('error',lang('update_error'));
				redirect('reservation/rooms/edit/'.$room_id);

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}

		//update değilse yeni ekle
		}else{
			$insert = $this->db->insert('rooms',$arr);
			$room_id = $this->db->insert_id();

			//diğer dillerdeki açıklamalar
			$this->db->delete('room_contents',array('room_id'=>$room_id));
			$description	= $this->input->post('description');

			foreach ($description as $key => $value) {
				$this->db->insert('room_contents',array(
					'lang'		=> $value['lang'],
					'content'	=> $value['desc'],
					'title'		=> $value['title'],
					'room_id'	=> $room_id,
					'hotel_id'	=> $hotel_id));
			}

			//children yaşlarını ekle
			if ($arr['max_child'] != '0') {
				$this->db->delete('room_children',array('room_id'=> $room_id));
				$children = $this->input->post('child_age');

				foreach ($children as $key => $child) {
					$this->db->insert('room_children',array(
						'room_id' => $room_id,
						'child_id' => $key,
						'child_min' => $child['min'],
						'child_max'	=> $child['max']));
				}

			}


			if ($insert) {
				$this->session->set_flashdata('success',lang('added_success'));
				redirect('reservation/rooms/edit/'.$room_id);
			}else{
				$this->session->set_flashdata('error',lagn('added_error'));
				redirect('reservation/rooms/add_new');

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}
		}

	}

	/*
	* Delete room by id
	* Used in jtable
	*/
	function delete_room(){
		$id = $this->input->post('id');

		$room 		= $this->db->delete('rooms',array('id' => $id));
		$photos 	= $this->db->delete('room_photos',array('room_id'=>$id));
		$children 	= $this->db->delete('room_children',array('room_id'=>$id));
		$content 	= $this->db->delete('room_contents',array('room_id'=>$id));
		$prices 	= $this->db->delete('prices',array('room_id'=>$id));

		//Return result to jTable
		$jTableResult = array();
		if ($room and $photos and $children and $content and $prices) {
			$jTableResult['Result'] = "OK";
		}else{
			$jTableResult['Result'] = "Error";
		}

		print json_encode($jTableResult);

	}

	function list_extras(){
		$hotel_id = $this->session->userdata('hotel_id');
		$query = $this->db->query("SELECT * FROM extras WHERE hotel_id='$hotel_id'");

		$result = array();
		$result['Result'] = "OK";
		$result['TotalRecordCount'] = $query->num_rows();
		$result['Records'] = $query->result();
		print json_encode($result);
	}


	function save_extra(){
		//load language
		$this->lang->load('reservation/extras',$this->language);
		
		$code 		= $this->session->userdata('code');
		$hotel_id 	= $this->session->userdata('hotel_id');

		$arr = array(
			'name' 			=> $this->input->post('name'),
			'description' 	=> $this->input->post('basic_desc'),
			'per' 			=> $this->input->post('per'),
			'price' 		=> json_encode($this->input->post('price')),
			'image' 		=> $this->input->post('extra_image'),
			'max_person' 	=> $this->input->post('max_person'),
			'forms' 		=> empty($this->input->post('forms')) ? 0 : $this->input->post('forms'),
			'available_days'=> null!==$this->input->post('available_days') ? implode(',',$this->input->post('available_days')) : '0',
			'status'		=> $this->input->post('status'),
			'hotel_id'		=> $hotel_id,
			'code'			=> $code);
		
		//echo $arr['forms'];
		//exit;

		//update mi yeni mi?
		if ($this->input->post('update') == 1) {
			$extra_id = $this->input->post('extra_id');

			$update = $this->db->update('extras',$arr,array('id' => $extra_id));
			//diğer dillerdeki açıklamalar
			$this->db->delete('extras_contents',array('extra_id'=>$extra_id));
			$description	= $this->input->post('description');

			foreach ($description as $key => $value) {
				$this->db->insert('extras_contents',array(
					'lang'		=> $value['lang'],
					'content'	=> $value['desc'],
					'title'		=> $value['title'],
					'extra_id'	=> $extra_id,
					'hotel_id'	=> $hotel_id,
					'code'		=> $code));
			}

			if ($update) {
				$this->session->set_flashdata('success',lang('update_success'));
				redirect('reservation/extras/edit/'.$extra_id);
			}else{
				$this->session->set_flashdata('error',lang('update_error'));
				redirect('reservation/extras/edit/'.$extra_id);

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}

		//update değilse yeni ekle
		}else{
			$insert = $this->db->insert('extras',$arr);
			$extra_id = $this->db->insert_id();

			//diğer dillerdeki açıklamalar
			$this->db->delete('extras_contents',array('extra_id'=>$extra_id));
			$description	= $this->input->post('description');

			foreach ($description as $key => $value) {
				$this->db->insert('extras_contents',array(
					'lang'		=> $value['lang'],
					'content'	=> $value['desc'],
					'title'		=> $value['title'],
					'extra_id'	=> $extra_id,
					'hotel_id'	=> $hotel_id,
					'code'		=> $code));
			}

			if ($insert) {
				$this->session->set_flashdata('success',lang('added_success'));
				redirect('reservation/extras/edit/'.$extra_id);
			}else{
				$this->session->set_flashdata('error',lang('added_error'));
				redirect('reservation/extras/add_new');

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}
		}

	}

	function seasons(){
		$hotel_id 	= $this->session->userdata('hotel_id');
		$code	 	= $this->session->userdata('code');

		$action = $this->input->get('action');

		switch ($action) {
			case 'list':
				
				$query = $this->db->query("SELECT * FROM seasons WHERE hotel_id='$hotel_id'");

				$result = array();
				$result['Result'] = "OK";
				$result['TotalRecordCount'] = $query->num_rows();
				$result['Records'] = $query->result();
				print json_encode($result);

				break;
			case 'create':
				
				$arr = array(
				'name' 			=> $this->input->post('name'),
				'start_date' 	=> $this->input->post('start_date'),
				'end_date' 		=> $this->input->post('end_date'),
				'early_reservation_days' 		=> $this->input->post('early_reservation_days'),
				'cancel_days' 	=> $this->input->post('cancel_days'),
				'min_stay' 		=> $this->input->post('min_stay'),
				'max_stay' 		=> $this->input->post('max_stay'),
				'hotel_id' 		=> $this->session->userdata('hotel_id'),
				'code' 			=> $this->session->userdata('code')
				);

				$this->db->insert('seasons',$arr);
				$id = $this->db->insert_id();

				$row = $this->db->query("SELECT * FROM seasons where id='$id'")->row();
				//Return result to jTable
				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				$jTableResult['Record'] = $row;
				print json_encode($jTableResult);

				break;

			case 'update':
				$id = $this->input->post('id');

				$arr = array(
				'name' 			=> $this->input->post('name'),
				'start_date' 	=> $this->input->post('start_date'),
				'end_date' 		=> $this->input->post('end_date'),
				'early_reservation_days' 		=> $this->input->post('early_reservation_days'),
				'cancel_days' 	=> $this->input->post('cancel_days'),
				'min_stay' 		=> $this->input->post('min_stay'),
				'max_stay' 		=> $this->input->post('max_stay'),
				'hotel_id' 		=> $this->session->userdata('hotel_id'),
				'code' 			=> $this->session->userdata('code')
				);

				$this->db->update('seasons',$arr,array('id'=>$id));

				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				print json_encode($jTableResult);

				break;

			case 'delete':
				$this->db->delete('seasons',array('id' =>$this->input->post('id')));
				$this->db->delete('season_prices',array('season_id' =>$this->input->post('id')));
				//Return result to jTable
				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				print json_encode($jTableResult);
				break;
			default:
				# code...
				break;
		}
		
	}

	/*
	* Room Adları option
	* Jtable child bölümünde
	*
	*/
	function hotel_rooms(){
		$this->load->model('reservation_model');
		$rooms = $this->reservation_model->jtable_hotel_rooms();
		
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options'] = $rooms;
		print json_encode($jTableResult);

	}

	/*
	* DEPRECATED!
	* THERE WILL BE NO SEASON PRICE
	* ITS ADDED TO BULK PRICE UPDATE
	*/
	function season_price(){
		$this->load->model('reservation_model');
		$season_id 	= $this->input->get('season_id');
		$action 	= $this->input->get('action');

		switch ($action) {
			case 'list':
				$prices 	= $this->reservation_model->get_season_prices($season_id);
	
				$result = array();
				$result['Result'] = "OK";
				$result['Records'] = $prices;
				print json_encode($result);
				break;
			case 'create':

				$arr = array(
					'room_id' 		=> $this->input->post('room_id'),
					'season_id' 	=> $this->input->post('season_id'),
					'base_price'	=> $this->input->post('base_price'),
					'double_price'	=> $this->input->post('double_price'),
					'triple_price'	=> $this->input->post('triple_price'),
					'extra_adult'	=> $this->input->post('extra_adult'),
					'child_price'	=> $this->input->post('child_price'),
					'extra_child'	=> $this->input->post('extra_child'),
					);

				$this->db->insert('season_prices',$arr);
				$id = $this->db->insert_id();

				$row = $this->db->query("SELECT * FROM season_prices where id='$id'")->row();
				//Return result to jTable
				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				$jTableResult['Record'] = $row;
				print json_encode($jTableResult);



				break;
			case 'update':
				$id = $this->input->post('id');
				$arr = array(
					'room_id' 		=> $this->input->post('room_id'),
					'season_id' 	=> $this->input->post('season_id'),
					'base_price'	=> $this->input->post('base_price'),
					'double_price'	=> $this->input->post('double_price'),
					'triple_price'	=> $this->input->post('triple_price'),
					'extra_adult'	=> $this->input->post('extra_adult'),
					'child_price'	=> $this->input->post('child_price'),
					'extra_child'	=> $this->input->post('extra_child'),
					);
				$this->db->update('season_prices',$arr,array('id'=>$id));

				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				print json_encode($jTableResult);


				break;

			case 'delete':
				$this->db->delete('season_prices',array('id' =>$this->input->post('id')));
				//Return result to jTable
				$jTableResult = array();
				$jTableResult['Result'] = "OK";
				print json_encode($jTableResult);
				break;
			default:
				# code...
				break;
		}

		
	}


	function add_prices(){
		//load language
		$this->lang->load('reservation/set_prices',$this->language);


		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$this->output->set_content_type('application/json');
		//load the model
		$this->load->model('reservation_model');

		$hotel_id		= $this->session->userdata('hotel_id');
		$code			= $this->session->userdata('code');
		$room_id		= $this->input->post('room_id');
		$price_type 	= $this->input->post('price_type');

		if ($this->input->post('by') == 'date') {
			$start_date		= $this->input->post('start_date');
			$end_date		= $this->input->post('end_date');
		}else{
			$season  		= $this->reservation_model->get_hotel_seasons($this->input->post('season'));
			$start_date		= $season->start_date;
			$end_date		= $season->end_date;

		}

		//Set prices
		$base_price		= $this->input->post('base_price');
		$single_price	= $this->input->post('single_price');
		$double_price	= $this->input->post('double_price');
		$triple_price	= $this->input->post('triple_price');
		$extra_adult	= $this->input->post('extra_adult');
		$child_price	= $this->input->post('child_price');

		$min_stay		= $this->input->post('min_stay');
		$max_stay		= $this->input->post('max_stay');
		$available		= $this->input->post('available');

		//salaklar start date'i end date'den sonrası bir tarihe girer falan
		if (strtotime($start_date) > strtotime($end_date)) {
			echo json_encode(array('status' => 'danger','message' => lang('error_date_range')));
			exit;
		}

		/*
		echo $start_date;
		echo '<br>';
		echo $end_date;
		print_r(date_range($start_date,$end_date));
		exit;
		*/
		foreach (date_range($start_date,$end_date) as $key => $date) {
	
			//get the day
			$day = strtotime($date);
			$dayName = date('D',$day);


			$arr = array(
				'room_id' 		=> $room_id,
				'hotel_id' 		=> $hotel_id,
				'price_date'	=> $date,
				'price_type'	=> $price_type,
				'available'		=> $available,
				'base_price'	=> $base_price,
				'single_price'	=> $single_price,
				'double_price'	=> $double_price,
				'triple_price'	=> $triple_price,
				'extra_adult'	=> $extra_adult,
				'child_price'	=> json_encode($child_price),
				'min_stay'		=> $min_stay,
				'max_stay'		=> $max_stay,
				'code'			=> $code);


			//if daily range is set, change the price's values by day name
			if ($this->input->post('daily_range_val') == 'on') {
				$daily_range = $this->input->post('daily_range');

				if (isset($daily_range[$dayName]) and $daily_range[$dayName] == 'on') {
					$insert = $this->reservation_model->insert_prices($arr);
				}
				/*
				print_r($daily_range);
				exit;
				$base_price		= $daily_range[$dayName]['base_price'];
				$single_price	= $daily_range[$dayName]['single_price'];
				$double_price	= $daily_range[$dayName]['double_price'];
				$triple_price	= $daily_range[$dayName]['triple_price'];
				$extra_adult	= $daily_range[$dayName]['extra_adult'];
				$child_price	= $daily_range[$dayName]['child_price'];
				*/
			}else{
				$insert = $this->reservation_model->insert_prices($arr);
			}

		}


		if ($insert) {
			echo json_encode(array('status' => 'success','message' => lang('success_message')));
		}else{
			echo json_encode(array('status' => 'danger','message' => lang('error_message')));
		}

	}

	function price_grid_update_by_room(){
		//load language
		$this->lang->load('reservation/set_prices',$this->language);

		$start_date		= $this->input->post('start_date');
		$end_date		= $this->input->post('end_date');

		if (strtotime($start_date) > strtotime($end_date)) {
			echo json_encode(array('status' => 'danger','message' => lang('date_error')));
			exit;
		}
		
		$arr = array(
		'room_id' 		=> $this->input->post('room_id'),
		'price_type' 	=> $this->input->post('price_type'),
		'min_stay' 		=> $this->input->post('min_stay'),
		'max_stay' 		=> $this->input->post('max_stay'),
		'available' 	=> $this->input->post('available'),
		'base_price'	=> $this->input->post('base_price'),
		'single_price' 	=> $this->input->post('single_price'),
		'double_price' 	=> $this->input->post('double_price'),
		'triple_price' 	=> $this->input->post('triple_price'),
		'extra_adult' 	=> $this->input->post('extra_price'),
		'child_price' 	=> json_encode($this->input->post('child_price')),
		'stoped_arrival'	=> empty($this->input->post('stoped_arrival')) ? '0' : '1',
		'stoped_departure'	=> empty($this->input->post('stoped_departure')) ? '0' : '1');

		$this->load->model('reservation_model');
		foreach (date_range($start_date,$end_date) as $key => $day) {
			$arr['price_date'] 	= $day;
			$update = $this->reservation_model->insert_prices($arr);
		}

		if ($update) {
			echo json_encode(array('status' => 'success','message' => lang('success_message')));
		}else{
			echo json_encode(array('status' => 'danger','message' => lang('error_message')));
		}
		
		//echo '<pre>';
		//print_r($stoped_arrival.' - '.$stoped_depart);
	}

	function list_price_plans(){
		$hotel_id = $this->session->userdata('hotel_id');

		$plans = $this->db->query("SELECT * FROM price_plans WHERE hotel_id = '$hotel_id'");

		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $plans->result();
		print json_encode($jTableResult);
		
	}

	function delete_price_plan(){
		$this->db->delete('price_plans',array('id' =>$this->input->post('id')));
		$this->db->delete('price_plans_availability',array('price_plan_id' =>$this->input->post('id')));
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);

	}

	/*
	* Price Plans AKA Promotions
	*/
	function add_price_plan(){
		//load language
		$this->lang->load('reservation/price_plans',$this->language);

		//echo '<pre>';
		//print_r($_POST);
		$update  	= $this->input->post('update');
		$hotel_id 	= $this->session->userdata('hotel_id');
		$code		= $this->session->userdata('code');
		$arr = array(
			'hotel_id' 			=> $hotel_id,
			'promotion_name' 	=> $this->input->post('promotion_name'),
			'promotion_discount'=> $this->input->post('promotion_discount'),
			'start_date' 		=> $this->input->post('start_date'),
			'end_date' 			=> $this->input->post('end_date'),
			'daily_range' 		=> implode(',',$this->input->post('daily_range')),
			'min_stay' 			=> $this->input->post('min_stay'),
			'booking_start' 	=> $this->input->post('booking_start'),
			'booking_end' 		=> $this->input->post('booking_end'),
			'last_min_qty' 		=> $this->input->post('last_min_qty'),
			'last_min_val' 		=> $this->input->post('last_min_val'),
			'twentyfour_date' 	=> $this->input->post('twentyfour_date'),
			'default_policy' 	=> $this->input->post('default_policy'),
			'rooms' 			=> implode(',',$this->input->post('rooms')),
			'promotion_type' 	=> $this->input->post('promotion_type'),
			'code'				=> $code
			);

		
		$this->load->model('reservation_model');

		//check if update
		if ($update == '1') {
			$plan_id = $this->input->post('promotion_id'); 
			$insert  = $this->db->update('price_plans',$arr,array('id'=>$plan_id));
		}else{
			$insert  = $this->db->insert('price_plans',$arr);
			$plan_id = $this->db->insert_id();
		}
		
		//create date range		
		$available 		= $this->input->post('available');
		$daily_range 	= $this->input->post('daily_range');
		$discount 		= $this->input->post('promotion_discount');

		foreach ($daily_range as $key => $value) {
			unset($daily_range[$key]);
			$daily_range[$value] = $value;
		}
		
		$rooms = explode(',', $arr['rooms']);

		//delete all availibility variables
		$this->db->delete('price_plans_availability',array('price_plan_id' => $plan_id));

		//add availability for each day
		foreach (date_range($arr['start_date'],$arr['end_date']) as $key => $date) {

		$day = strtotime($date);
		$dayName = date('D',$day);	

			//add availibility to all rooms
			foreach ($rooms as $k => $room) {
				$vars = array(
				'available' 	=> $available,
				'price_date' 	=> $date,
				'price_plan_id'	=> $plan_id,
				'room_id'		=> $room,
				'discount'		=> $discount);

				if (isset($daily_range[$dayName])) {
					$this->reservation_model->insert_price_plan_availability($vars);
				}
			}
			
		}


		//if not update redirect to plan edit page
		if ($update == '0') {
			if ($insert) {
				$this->session->set_flashdata('statusSuccess', lang('added_success'));
				redirect(site_url('reservation/price_plans/edit/'.$plan_id));
			}else{
				$this->session->set_flashdata('statusError', lang('added_error'));
				redirect(site_url('reservation/price_plans/edit/'.$plan_id));
			}
		}else{
			if ($insert) {
				echo json_encode(array('status' => 'success','message' => lang('update_success')));
			}else{
				echo json_encode(array('status' => 'danger','message' => lang('update_error')));
			}

		}

	}

	function price_grid_update_promo(){
		//load language
		$this->lang->load('reservation/set_prices',$this->language);


		$start_date 	= $this->input->post('start_date');
		$end_date 		= $this->input->post('end_date');

		if (strtotime($start_date) > strtotime($end_date)) {
			echo json_encode(array('status' => 'danger','message' => lang('date_error')));
			exit;
		}

		$available 		= $this->input->post('promo_available');
		$promotion_id 	= $this->input->post('promotion_id');
		$room_id 		= $this->input->post('promotion_room_id');
		$stoped 		= empty($this->input->post('promo_stoped')) ? '0' : '1';

		$arr = array(
			'available' => $available,
			'stoped'	=> $stoped,
			'room_id'	=> $room_id,
			'price_plan_id'	=> $promotion_id);

		$this->load->model('reservation_model');
		foreach (date_range($start_date,$end_date) as $key => $day) {
			$arr['price_date'] 	= $day;
			$update = $this->reservation_model->update_price_plan($arr);
		}

		if ($update) {
			echo json_encode(array('status' => 'success','message' => lang('success_message')));
		}else{
			echo json_encode(array('status' => 'danger','message' => lang('error_message')));
		}

	}


	function delete_room_photos(){
		$photos = $this->input->post('photos');

		$output = array();
		foreach ($photos as $p => $id) {
			//delete file
			$row = $this->db->query("SELECT * FROM room_photos WHERE id ='$id'")->row();
			$path = parse_url($row->photo_url);
			if (file_exists(FCPATH.$path['path'])) {
				unlink(FCPATH.$path['path']);
			}
			
			//delete row from dbs
			$del = $this->db->delete('room_photos',array('id'=>$id));
			$output[] = $id;
			
		}

		//return deleted items ids
		if ($del) {
			echo json_encode(array('status' => 'success','message' => json_encode($output)));
		}else{
			echo json_encode(array('status' => 'danger','message' => 'Error! Please Try Again.'));
		}
	}

	function delete_hotel_photos(){
		$photos = $this->input->post('photos');

		$output = array();
		foreach ($photos as $p => $id) {
			//delete file
			$row = $this->db->query("SELECT * FROM hotel_photos WHERE id ='$id'")->row();
			$path = parse_url($row->photo_url);
			if (file_exists(FCPATH.$path['path'])) {
				unlink(FCPATH.$path['path']);
			}
			
			//delete row from dbs
			$del = $this->db->delete('hotel_photos',array('id'=>$id));
			$output[] = $id;
			
		}

		//return deleted items ids
		if ($del) {
			echo json_encode(array('status' => 'success','message' => json_encode($output)));
		}else{
			echo json_encode(array('status' => 'danger','message' => 'Error! Please Try Again.'));
		}
	}

	function list_policies(){
		$hotel_id = $this->session->userdata('hotel_id');

		$policies = $this->db->query("SELECT id,policy_name FROM policies WHERE hotel_id = '$hotel_id'");
		
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $policies->result();
		print json_encode($jTableResult);
	}

	function add_policy(){
		//load language
		$this->lang->load('reservation/policies',$this->language);

		$name 	= $this->input->post('name');
		$extra 	= $this->input->post('extra_policies');
		$policy	= $this->input->post('policy');

		//create an array for translations
		foreach ($policy['description'] as $k => $desc) {
			$description[$desc['lang']] = $desc['desc'];
		}

		$policy['name'] 		= $name;
		$policy['extra']		= $extra;
		$policy['description'] 	= $description;

		$hotel_id 	= $this->session->userdata('hotel_id');
		$code 		= $this->session->userdata('code');

		$arr = array(
			'policy_name' 	=> $name,
			'policy_extra'	=> $extra,
			'policy_details'=> json_encode($policy),
			'hotel_id'		=> $hotel_id,
			'code' 			=> $code);

		//check if update
		if ($this->input->post('update') == '1') {
			$id = $this->input->post('policy_id');
			$insert = $this->db->update('policies',$arr,array('id'=>$id));
		}else{
			$insert = $this->db->insert('policies',$arr);
			$id 	= $this->db->insert_id();
		}
		

		if ($insert) {
			$this->session->set_flashdata('status_succes', lang('success'));
			redirect(site_url('reservation/policies/edit/'.$id));
		}else{
			$this->session->set_flashdata('status_error', lang('error'));
			redirect(site_url('reservation/policies/add_new'));
		}
		
    	
	}

	function delete_policy(){
		$this->db->delete('policies',array('id' =>$this->input->post('id')));
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	function room_children(){
		$room_id = $this->input->get('id');
		$this->load->model('reservation_model');
		$child = $this->reservation_model->room_children($room_id);

		echo json_encode($child);
	}


	function upload_extra_image(){
		$hotel_id = $this->session->userdata('hotel_id');
		$config['upload_path']   =   "uploads/".$hotel_id."/extras/";

		if (!is_dir($config['upload_path'])) {
		    mkdir($config['upload_path'], 0777, TRUE);
		}

		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "5000";
		$config['max_width']     =   "2400";
		$config['max_height']    =   "2400";

		$config['maintain_ratio']   = FALSE;      
        $config['width'] = "140";      
        $config['height'] = "115";

		$this->load->library('upload',$config);

		$file_name = $hotel_id.'-'.time();

		if(!$this->upload->do_upload('userfile',$file_name)){
		   echo $this->upload->display_errors();
		}else{

			$finfo=$this->upload->data();

			//$image_data = $this->upload->data();
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $finfo['full_path'];
			$config2['maintain_ratio'] = FALSE;
			$config2['width'] = 600;
			$config2['height'] = 280;
			$config2['overwrite'] = TRUE;
			$this->load->library('image_lib',$config2); 

			if ( !$this->image_lib->resize()){
				echo json_encode(array('status'=>'error'));  
			}else{
				$file_name =$finfo['raw_name'].$finfo['file_ext'];
				$response = site_url('uploads/'.$hotel_id.'/extras/'.$file_name);

				echo json_encode(array('status'=>'success','image'=>$response));
			}


		}

	}

	/*
	* Upload Hotel Logo
	*/

	function upload_hotel_logo(){
		$hotel_id = $this->session->userdata('hotel_id');
		$config['upload_path']   =   "uploads/".$hotel_id."/logos/";

		if (!is_dir($config['upload_path'])) {
		    mkdir($config['upload_path'], 0777, TRUE);
		}

		$config['allowed_types'] =   "gif|jpg|jpeg|png"; 
		$config['max_size']      =   "1024";
		$config['max_width']     =   "2400";
		$config['max_height']    =   "2400";

		$config['maintain_ratio']   = FALSE;      
        $config['width'] = "200";      
        $config['height'] = "100";
        $config2['overwrite'] = TRUE;
		$file_name = $hotel_id.'_logo';
		$config['file_name'] = $file_name;

		$this->load->library('upload',$config);


		if(!$this->upload->do_upload('userfile',$file_name)){
		   echo $this->upload->display_errors();
		}else{

			$finfo=$this->upload->data();

			//$image_data = $this->upload->data();
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $finfo['full_path'];
			$config2['maintain_ratio'] = FALSE;
			$config2['width'] = 200;
			$config2['height'] = 100;
			$config2['overwrite'] = TRUE;
			$this->load->library('image_lib',$config2); 

			if ( !$this->image_lib->resize()){
				echo json_encode(array('status'=>'error'));  
			}else{
				$file_name =$finfo['raw_name'].$finfo['file_ext'];
				$response = site_url('uploads/'.$hotel_id.'/logos/'.$file_name);

				echo json_encode(array('status'=>'success','image'=>$response));
			}


		}

	}

	function _createThumbnail($filename){
        $config['image_library']    = "gd2";      
        $config['source_image']     = "uploads/extras/thumbs" .$filename;      
        $config['create_thumb']     = TRUE;      
        $config['maintain_ratio']   = FALSE;      
        $config['width'] = "600";      
        $config['height'] = "280";
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }      
 
    }

    /*
    * List reservations for JTable
    */
    function list_reservations(){
    	$hotel_id = $this->session->userdata('hotel_id');


    	//get listing options
    	$jtStartIndex 	= $this->input->get('jtStartIndex') ? $this->input->get('jtStartIndex') : 0;
    	$jtPageSize		= $this->input->get('jtPageSize') ? $this->input->get('jtPageSize') : 5;
    	$jtSorting		= $this->input->get('jtSorting') ? $this->input->get('jtSorting') : 'id DESC';

    	//search criteria
    	$whr = '';
    	if ($this->input->post('first_name') and !empty($this->input->post('first_name'))) {
    		$name = $this->input->post('first_name');
    		$whr .= ' and first_name LIKE "%'.$name.'%"';
    	}

    	if ($this->input->post('last_name') and !empty($this->input->post('last_name'))) {
    		$last_name = $this->input->post('last_name');
    		$whr .= ' and last_name LIKE "%'.$last_name.'%"';
    	}

    	if ($this->input->post('start_date') and !empty($this->input->post('start_date'))) {
    		$start_date = $this->input->post('start_date');
    		$whr .= ' and date(checkin) = "'.$start_date.'" ';
    	}

    	if ($this->input->post('end_date') and !empty($this->input->post('end_date'))) {
    		$end_date = $this->input->post('end_date');
    		$whr .= ' and date(checkout) = "'.$end_date.'" ';
    	}



    	$query = "SELECT id,name_title,first_name,last_name,checkin,checkout 
    	FROM reservations WHERE hotel_id=$hotel_id $whr ORDER BY $jtSorting LIMIT $jtStartIndex,$jtPageSize";

    	//echo $query; exit;

    	//ccount total items for pagination
    	$total = "SELECT count(id) as total FROM reservations WHERE hotel_id=$hotel_id $whr";

    	$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $this->db->query($total)->row()->total;
		$jTableResult['Records'] = $this->db->query($query)->result();
		print json_encode($jTableResult);

    }	

}