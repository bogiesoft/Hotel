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

	function hotel_photos($id){
		return $this->db->query("SELECT * FROM hotel_photos WHERE hotel_id='$id' ORDER BY id DESC")->result();	
	}

	function room_details($id){
		return $this->db->query("SELECT * FROM rooms WHERE id = '$id'")->row();
	}

	function room_description($id){
		return $this->db->query("SELECT * FROM room_contents WHERE room_id='$id' ORDER BY lang")->result();
	}

	function room_photos($id){
		return $this->db->query("SELECT * FROM room_photos WHERE room_id='$id' ORDER BY id DESC")->result();	
	}

	function room_children($id){
		$db = $this->db->query("SELECT * FROM room_children WHERE room_id='$id' ORDER BY child_id");

		if ($db->num_rows() > 0) {
			$child = array();
			foreach ($db->result() as $key => $value) {
				$child[$value->child_id] = $value;
			}
			return $child;

		}
		else{
			return false;
		}
	}	

	function extra_details($id){
		return $this->db->query("SELECT * FROM extras WHERE id = '$id'")->row();
	}

	function extra_description($id){
		return $this->db->query("SELECT * FROM extras_contents WHERE extra_id='$id' ORDER BY lang")->result();
	}

	function get_hotel_rooms(){
		$hotel_id = $this->session->userdata('hotel_id');
		$rooms = $this->db->query("SELECT id,name,capacity,min_child,max_child,preferences FROM rooms WHERE hotel_id=$hotel_id order by id")->result();
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

		$sql = "SELECT * FROM prices WHERE hotel_id='$hotel_id' $whr and date(price_date) >= '$start' and date(price_date) <= '$end' order by price_date";
		$query = $this->db->query($sql);

		if ($query->num_rows() < 1) {
			return false;
		}else{
			return $query->result();
		}
	}

	function get_bar_by_room($date,$room_id){
		$hotel_id 	= $this->session->userdata('hotel_id');
		$sql = "SELECT * FROM prices WHERE hotel_id='$hotel_id' and room_id='$room_id' and date(price_date) = '$date' order by price_date";
		return  $this->db->query($sql)->row_array();
	}

	function insert_prices($arr){
		$hotel_id 	= $this->session->userdata('hotel_id');
		$room_id  	= $arr['room_id'];
		$date 		= $arr['price_date'];
		//var mı?
		$check = $this->db->query("
			SELECT count(id) as total FROM prices 
			WHERE date(price_date)='$date' and room_id='$room_id'
		");

		$arr['hotel_id'] = $hotel_id;
		if ($check->row()->total > 0) {
			$insert = $this->db->update('prices',$arr,array('room_id' => $room_id, 'price_date'=> $date));
		}else{
			$insert = $this->db->insert('prices',$arr);
		}

		return $insert;


	}

	function get_promotions(){
		$hotel_id = $this->session->userdata('hotel_id');
		$proms = $this->db->query("SELECT * FROM price_plans WHERE hotel_id = $hotel_id");

		if ($proms->num_rows() >0) {
			return $proms->result_array();
		}else{
			return false;
		}
		
	}

	function get_policies(){
		$hotel_id = $this->session->userdata('hotel_id');
		$proms = $this->db->query("SELECT * FROM policies WHERE hotel_id = $hotel_id");

		if ($proms->num_rows() >0) {
			return $proms->result();
		}else{
			return false;
		}
		
	}

	/*
	* On rates page
	*/
	function update_price_plan($arr){
		$plan_id  	= $arr['price_plan_id'];
		$date 		= $arr['price_date'];
		$room_id 	= $arr['room_id'];

		$check = $this->db->query("
			SELECT count(id) as total FROM price_plans_availability 
			WHERE room_id = '$room_id' and date(price_date)='$date' and price_plan_id='$plan_id'
		");

		
		if ($check->row()->total > 0) {
			$insert = $this->db->update('price_plans_availability',$arr,array('price_plan_id' => $plan_id, 'price_date'=> $date, 'room_id' => $room_id));
		}else{
			$insert = $this->db->insert('price_plans_availability',$arr);
		}

		return $insert;

	}

	function insert_price_plan_availability($arr){
		$plan_id  	= $arr['price_plan_id'];
		$date 		= $arr['price_date'];
		$room_id 	= $arr['room_id'];

		$insert = $this->db->insert('price_plans_availability',$arr);


		/* this sucks

		$check = $this->db->query("
			SELECT count(id) as total FROM price_plans_availability 
			WHERE room_id = '$room_id' and date(price_date)='$date' and price_plan_id='$plan_id'
		");

		
		if ($check->row()->total > 0) {
			$insert = $this->db->update('price_plans_availability',$arr,array('price_plan_id' => $plan_id, 'price_date'=> $date, 'room_id' => $room_id));
		}else{
			$insert = $this->db->insert('price_plans_availability',$arr);
		}
		*/

		return $insert;
	}

	function price_plan_detail($id){

		return $this->db->query("SELECT * FROM price_plans WHERE id = '$id'")->row();

	}

	function policy_detail($id){
		return $this->db->query("SELECT * FROM policies WHERE id ='$id'")->row();
	}

	function reservation_info($id){
		return $this->db->query("SELECT r.*,c.name as country_name FROM reservations as r 
			INNER JOIN countries as c ON r.country=c.code  WHERE r.id=$id")->row();
	}

}