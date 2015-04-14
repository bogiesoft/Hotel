<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ADMIN_Controller extends MY_Controller
{
	
	function __construct()
	{

		parent::__construct();

		
		$this->language = 'en';
		$this->load->helper('general');

		//load language

		if ($this->session->userdata('user_lang')) {
			$this->language = $this->session->userdata('language');
		}

		$this->lang->load('general',$this->language);
	}
}