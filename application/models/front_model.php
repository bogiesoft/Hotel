<?php

/**
* Front model
*/
class Front_Model extends CI_Model{

	function hotel_info($id){

		$q = $this->db->query("SELECT * FROM hotels WHERE id  = $id");

		if ($q->num_rows() > 0) {
			return $q->row();
		}else{
			return false;
		}

	}


	function get_hotel_rooms($hotel_id,$arr=array()){
		$child 		= $arr['child'];
		$adults 	= $arr['adults'];
		$lang 		= $arr['language'];

		
		$rooms = $this->db->query("SELECT
		    *
		FROM
		    rooms AS r LEFT JOIN room_contents AS rc
		        ON rc.room_id = r.id
		    AND rc.lang = '$lang'
		WHERE
		    r.hotel_id = $hotel_id 
		    AND(
		        r.min_adult <= $adults
		        AND
		        r.max_adult >= $adults
		    )AND(
		        r.min_child <= $child
		        AND r.max_child >=$child
		    )
		GROUP BY
		    r.id
		    ORDER BY
		    r.id");

		if ($rooms->num_rows() > 0) {
			return $rooms->result();
		}else{
			return false;
		}
		
	}


	function get_promotions($hotel_id){
		//$hotel_id = $this->session->userdata('hotel_id');
		$proms = $this->db->query("SELECT * FROM price_plans WHERE hotel_id = $hotel_id");

		if ($proms->num_rows() >0) {
			return $proms->result_array();
		}else{
			return false;
		}
		
	}

	function get_bar_by_room($date,$room_id){
		//$hotel_id 	= $this->session->userdata('hotel_id');
		return  $this->db->query( "SELECT * FROM prices 
			WHERE room_id='$room_id' and date(price_date) = '$date' 
			order by price_date")->row_array();
	}


	function get_room_photos($id){
		return $this->db->query("SELECT * FROM room_photos WHERE room_id = $id")->result_array();
	}

	function get_extras($hotel_id,$lang){
		return $this->db->query("SELECT * FROM extras as e 
			LEFT JOIN extras_contents as ec ON ec.extra_id = e.id
			WHERE e.hotel_id = $hotel_id and ec.lang='$lang' and status=1")->result_array();
	}

	function room_preferences($id){
		return $this->db->query("SELECT preferences FROM rooms where id=$id")->row();
	}

}