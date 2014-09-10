<?php
/**
* 
*/
class Reservation_Model extends CI_Model
{
	
	function hotel_details($id){
		return $this->db->query("SELECT * FROM hotels WHERE id = '$id'")->row();
	}
}