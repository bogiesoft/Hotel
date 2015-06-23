<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class STAFF_Controller extends MY_Controller
{
	
	function __construct(){

		parent::__construct();

		if (!$this->session->userdata('is_staff')) {
			redirect(site_url('login/staff'));
		}
		
	}
}