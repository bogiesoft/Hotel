<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct(){
		parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			redirect(site_url('login'));
		}
		
	}

	public function index(){
		//echo $this->session->userdata('user_id');

		$this->load->view('dashboard');
	}
	
}
