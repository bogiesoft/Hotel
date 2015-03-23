<?php

/**
* Dashboard Model
*/
class Dashboard_Model extends CI_Model{

	function reservation_stats(){
		$hotel_id = $this->session->userdata('hotel_id');

		//$calendar_
	}

	function calendar_events(){
		$hotel_id = $this->session->userdata('hotel_id');

		$events = $this->db->query("SELECT name_title, CONCAT_WS(' ',name_title,first_name,last_name) as title, 
			checkin as start, checkout as end
			FROM reservations
			WHERE hotel_id = $hotel_id and checkout > (CURDATE() - INTERVAL 30 DAY)")->result();

		return $events;
	}

}