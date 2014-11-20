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

	function set_hotel(){
		$id 		= $this->input->get('id');
		$redirect 	= $this->input->get('redirect');

		$hotel = $this->db->query("SELECT id,name FROM hotels where id ='$id'")->row();

		$user_data =  array(
					'hotel_id'  => $hotel->id,
					'hotel_name'=> $hotel->name);

		$this->session->set_userdata($user_data);

		redirect(site_url($redirect));
	}
	
}
