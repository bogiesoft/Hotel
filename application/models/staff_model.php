<?php

/**
* Dashboard Model
*/
class Dashboard_Model extends CI_Model{

	function check_staff($username,$pass){
		$query = $this->db->select('*')
			->from('staff')
			->where('username',$username)
			->where('pass',$pass)
			->get()->row();

		return $query;

	}
}