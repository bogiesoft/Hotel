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
		$specs = $this->input->post('description');

		//$specs = implode(',', $specs);
		echo '<pre>';
		print_r($specs);

	}


}