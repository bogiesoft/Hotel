<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ema extends ADMIN_Controller {

	function __construct(){
		parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			redirect(site_url('login'));
		}
		$this->load->helper('general_helper');
		
	}


	function index(){
	
		$this->load->view('ema/index');
	}


}

