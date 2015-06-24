<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_actions extends ADMIN_Controller {


	function __construct(){
		parent::__construct();


	}

	function save_hotel(){
			//load language
			$this->lang->load('reservation/hotels',$this->language);

			$is_staff = $this->session->userdata('is_staff');

			$arr = array(
			'name' 			=> $this->input->post('name'),
			'adress' 		=> $this->input->post('adress'),
			'phone' 		=> $this->input->post('phone'),
			'phone2' 		=> $this->input->post('phone2'),
			'fax' 			=> $this->input->post('fax'),
			'email' 		=> $this->input->post('email'),
			'website'		=> $this->input->post('website'),
			'city' 			=> $this->input->post('city'),
			'postcode' 		=> $this->input->post('postcode'),
			'currency' 		=> $this->input->post('currency'),
			'administrator' => $this->input->post('administrator'),
			'reception_phone'=> $this->input->post('reception_phone'),
			'reception_email'=> $this->input->post('reception_email'),
			'commision' 	=> $this->input->post('commision')
			);

			
			$hotel_id = $this->input->post('hotel_id');

			$update = $this->db->update('hotels',$arr,array('id' => $hotel_id));
			//diğer dillerdeki açıklamalar
			$this->db->delete('hotel_contents',array('hotel_id'=>$hotel_id));
			$description	= $this->input->post('description');


			if ($update) {
				$this->session->set_flashdata('success',lang('update_success'));
				redirect('staff/hotel_edit/'.$hotel_id);
				
				
			}else{
				$this->session->set_flashdata('error',lang('update_error'));
				redirect('staff/hotels/add_new');
				//echo json_encode(array('status' => 'danger','message' => 'Otel Eklenemedi, Lütfen Tekrar Deneyin.'));
			}


			

		}

}