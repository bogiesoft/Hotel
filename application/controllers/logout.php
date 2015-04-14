<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends ADMIN_Controller {

	public function index()
	{	
		$user_data =  array('user_id'	=> $account->id,
								'name' 		=> $account->name,
								'surname'	=> $account->surname,
								'status'	=> $account->status,
								'code'		=> $account->code,
								'hotel_id'  => $hotel->id,
								'hotel_name'=> $hotel->name);
			
		$this->session->unset_userdata($user_data);
		//print_r($this->session->userdata);
		redirect(site_url('login'));
	}


}