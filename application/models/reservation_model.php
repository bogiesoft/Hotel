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
}