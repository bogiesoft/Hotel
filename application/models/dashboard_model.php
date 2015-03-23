<?php

/**
* Dashboard Model
*/
class Dashboard_Model extends CI_Model{

	function reservation_stats($today,$last_month){
		$hotel_id = $this->session->userdata('hotel_id');

		$reservation = $this->db->query("SELECT count(id) as total,sum(total_price) as total_price,currency,
			DATE_FORMAT(reservation_date,'%Y-%m-%d') as reservation_date
			FROM reservations
			WHERE hotel_id = $hotel_id and reservation_date > (CURDATE() - INTERVAL 30 DAY)
			GROUP BY reservation_date")->result_array();


		//set reservation date as key
		$data = array();
		foreach ($reservation as $key => $value) {
			$data[$value['reservation_date']] = $value;
		}

		$output = array();
		foreach(date_range($last_month,$today) as $k => $date){
			if (isset($data[$date])) {
				$output[$date] =  $data[$date];
			}else{
				$output[$date]['total'] = 0;
				$output[$date]['total_price'] = 0;
				$output[$date]['currency'] = NULL;
				$output[$date]['reservation_date'] = $date;

			}
			
		}

		return $output;
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