<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_actions extends MY_Controller {

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
				$this->session->set_flashdata('success','Otel başarıyla düzenlendi.');
				redirect('reservation/hotels/edit/'.$hotel_id);
			}else{
				$this->session->set_flashdata('error','Otel Düzenlenemedi, Lütfen Tekrar Deneyin.');
				redirect('reservation/hotels/edit/'.$hotel_id);

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
				$this->session->set_flashdata('success','Otel başarıyla eklendi.');
				redirect('reservation/hotels/edit/'.$hotel_id);
			}else{
				$this->session->set_flashdata('error','Otel Eklenemedi, Lütfen Tekrar Deneyin.');
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
		$code 		= $this->session->userdata('code');
		$hotel_id 	= $this->session->userdata('hotel_id');

		$arr = array(
			'name' 			=> $this->input->post('name'),
			'capacity' 		=> $this->input->post('capacity'),
			'min_capacity' 	=> $this->input->post('min_capacity'),
			'max_capacity' 	=> $this->input->post('max_capacity'),
			'min_adult' 	=> $this->input->post('min_adult'),
			'max_adult' 	=> $this->input->post('max_adult'),
			'min_child' 	=> $this->input->post('min_child'),
			'max_child' 	=> $this->input->post('max_child'),
			'child_age' 	=> $this->input->post('child_age'),
			'room_units' 	=> null!==$this->input->post('room_units') ? implode(',',$this->input->post('room_units')) : '0',
			'hotel_id'		=> $hotel_id,
			'code'			=> $code);

		//update mi yeni mi?
		if ($this->input->post('update') == 1) {
			$room_id = $this->input->post('room_id');

			$update = $this->db->update('rooms',$arr,array('id' => $hotel_id));
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

			if ($update) {
				$this->session->set_flashdata('success','Oda başarıyla düzenlendi.');
				redirect('reservation/rooms/edit/'.$room_id);
			}else{
				$this->session->set_flashdata('error','Oda Düzenlenemedi, Lütfen Tekrar Deneyin.');
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

			if ($insert) {
				$this->session->set_flashdata('success','Oda başarıyla eklendi.');
				redirect('reservation/rooms/edit/'.$room_id);
			}else{
				$this->session->set_flashdata('error','Oda Eklenemedi, Lütfen Tekrar Deneyin.');
				redirect('reservation/rooms/add_new');

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}
		}

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
		$code 		= $this->session->userdata('code');
		$hotel_id 	= $this->session->userdata('hotel_id');

		$arr = array(
			'name' 			=> $this->input->post('name'),
			'description' 	=> $this->input->post('basic_desc'),
			'per' 			=> $this->input->post('per'),
			'price' 		=> $this->input->post('price'),
			'start_date' 	=> $this->input->post('start_date'),
			'end_date' 		=> $this->input->post('end_date'),
			'available_days'=> null!==$this->input->post('available_days') ? implode(',',$this->input->post('available_days')) : '0',
			'status'		=> $this->input->post('status'),
			'hotel_id'		=> $hotel_id,
			'code'			=> $code);

		//update mi yeni mi?
		if ($this->input->post('update') == 1) {
			$extra_id = $this->input->post('extra_id');

			$update = $this->db->update('extras',$arr,array('id' => $hotel_id));
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
				$this->session->set_flashdata('success','Extra başarıyla düzenlendi.');
				redirect('reservation/extras/edit/'.$room_id);
			}else{
				$this->session->set_flashdata('error','Extra Düzenlenemedi, Lütfen Tekrar Deneyin.');
				redirect('reservation/extras/edit/'.$room_id);

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
				$this->session->set_flashdata('success','Oda başarıyla eklendi.');
				redirect('reservation/extras/edit/'.$room_id);
			}else{
				$this->session->set_flashdata('error','Oda Eklenemedi, Lütfen Tekrar Deneyin.');
				redirect('reservation/extras/add_new');

				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}
		}

	}



}