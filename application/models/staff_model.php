<?php

/**
* Staff Model
*/
class Staff_Model extends CI_Model{

	function check_staff($username,$pass){
		$query = $this->db->select('*')
			->from('staff')
			->where('username',$username)
			->where('pass',$pass)
			->get()->row();

		return $query;

	}

	function get_hotels(){
		return $this->db->select('*')
			->from('hotels')
			->get()->result();

	}

	function hotel_detail($id){
		return $this->db->select('*')
			->from('hotels')
			->where('id',$id)
			->get()->row();

	}	
}