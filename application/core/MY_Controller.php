<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
	
	function __construct()
	{

		$this->language = 'en';

		parent::__construct();

		$this->load->helper('general');

		//load language

		if ($this->session->userdata('user_lang')) {
			$this->language = $this->session->userdata('language');
		}

		$this->lang->load('general',$this->language);
	}
}