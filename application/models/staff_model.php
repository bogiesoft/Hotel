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

	function hotel_reservations($id){

		//sql kodu şu
		// 14 numaralı otelin son 1 yıllık rezervasyonlarını getirir, status ve aya göre gruplar
		/*
		SELECT DATE_FORMAT( reservation_date,  '%Y' ) as YEAR, DATE_FORMAT( reservation_date,  '%m' ) AS 
		month , 
		status , COUNT( 
		STATUS ) AS total
		FROM  `reservations` 
		WHERE hotel_id =14 and reservation_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
		GROUP BY month , 
		status
		*/

		return $this->db->query("SELECT 
			DATE_FORMAT( reservation_date,  '%Y' ) as year, 
			DATE_FORMAT( reservation_date,  '%m' ) AS month, 
			status, 
			COUNT(STATUS) AS total
			FROM  reservations
			WHERE hotel_id=$id 
			and reservation_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR)
			GROUP BY month,status
			ORDER BY year DESC,month DESC")->result();
	}
}