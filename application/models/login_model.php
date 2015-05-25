<?php

/**
* 
*/
class Login_Model extends CI_Model
{
	
	function check_account($code,$pass){
		$pass = sha1(md5($pass));
		$check = $this->db->query("SELECT * FROM accounts WHERE code = $code and password ='$pass'");

		if($check->num_rows() > 0){
			return $check->row();

		}else{
			return false;
		}
	}

	function default_hotel($code){
		$check = $this->db->query("SELECT id,name From hotels where code='$code' and is_default=1");
		if ($check->num_rows()>0) {
			return $check->row();
		}else{
			return '0';
		}
	}

	function set_last_login($id){
		$data = array('last_login'=>date('Y-m-d H:i:s'));
		$this->db->update('accounts', $data, array('id' => $id));
	}

}
