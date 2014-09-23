<?php
/**
* 
*/
class Reservation_Model extends CI_Model
{
	
	function hotel_details($id){
		return $this->db->query("SELECT * FROM hotels WHERE id = '$id'")->row();
	}

	function countries(){
		return $this->db->query("SELECT * FROM countries")->result();
	}

	function hotel_description($id){
		return $this->db->query("SELECT * FROM hotel_contents WHERE hotel_id='$id' ORDER BY lang")->result();
	}

	function room_details($id){
		return $this->db->query("SELECT * FROM rooms WHERE id = '$id'")->row();
	}

	function room_description($id){
		return $this->db->query("SELECT * FROM room_contents WHERE room_id='$id' ORDER BY lang")->result();
	}

	function extra_details($id){
		return $this->db->query("SELECT * FROM extras WHERE id = '$id'")->row();
	}

	function extra_description($id){
		return $this->db->query("SELECT * FROM extras_contents WHERE extra_id='$id' ORDER BY lang")->result();
	}

	function get_hotel_rooms(){
		$hotel_id = $this->session->userdata('hotel_id');
		$rooms = $this->db->query("SELECT * FROM rooms WHERE hotel_id=$hotel_id order by id")->result();

		return $rooms;
	}

	function get_hotel_seasons($id=''){
		$hotel_id = $this->session->userdata('hotel_id');
		$whr = '';
		if ($id>0) {
			$whr .= " and id='$id'";
		}
		$sql = "SELECT id,name,start_date,end_date FROM seasons WHERE hotel_id=$hotel_id $whr order by id";
		if ($id > 0) {
			$season = $this->db->query($sql)->row();
		}else{
			$season = $this->db->query($sql)->result();
		}

		return $season;
	}

	function jtable_hotel_rooms(){
		$hotel_id = $this->session->userdata('hotel_id');
		$rooms = $this->db->query("SELECT id as Value,name as DisplayText FROM rooms WHERE hotel_id=$hotel_id order by Value")->result();

		return $rooms;

	}

	function get_season_prices($season_id){

		$prices = $this->db->query("SELECT * FROM season_prices WHERE season_id = '$season_id'");

		return $prices->result();
	}

	function check_bar($hotel_id,$start,$end,$room=''){
		$whr = '';
		if ($room>0) {
			$whr .=" and room_id='$room'";
		}

		$sql = "SELECT * FROM prices WHERE hotel_id='$hotel_id' $whr and price_date >= '$start' and price_date <= '$end' order by price_date";
		$query = $this->db->query($sql);

		if ($query->num_rows() < 1) {
			return false;
		}else{
			return $query->result();
		}
	}

	function insert_prices($arr){

		$room_id  	= $arr['room_id'];
		$date 		= $arr['price_date'];
		//var mı?
		$check = $this->db->query("
			SELECT count(id) as total FROM prices 
			WHERE price_date='$date' and room_id='$room_id'
		");

		if ($check->row()->total > 0) {
			$insert = $this->db->update('prices',$arr,array('room_id' => $room_id, 'price_date'=> $date));
		}else{
			$insert = $this->db->insert('prices',$arr);
		}

		return $insert;


	}
		
}