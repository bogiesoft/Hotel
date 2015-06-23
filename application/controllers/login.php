<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends ADMIN_Controller {

	public function index()
	{	
		$data['title'] = 'Login';
		$this->load->view('login');
		//first destroy all session
		$this->session->sess_destroy();

	}

	function post(){
		$code = $this->input->post('code');
		$pass = $this->input->post('password');


		if(empty($code)){
			$this->session->set_flashdata('error', 'Kullanıcı Kodunu Giriniz');
			redirect(site_url('login'));
			die;
		}

		if(empty($pass)){
			$this->session->set_flashdata('error', 'Şifrenizi Giriniz!');
			redirect(site_url('login'));
			die;
		}

		$this->load->model('login_model');
		$account = $this->login_model->check_account($code,$pass);


		if(!$account){
			$this->session->set_flashdata('error', 'Kullanıcı Bilgileri Hatalı!');
			redirect(site_url('login'));
		}else{

			$hotel = $this->login_model->default_hotel($account->code);

			//set last login
			$this->login_model->set_last_login($account->id);

			$user_data =  array('user_id'	=> $account->id,
								'name' 		=> $account->name,
								'surname'	=> $account->surname,
								'status'	=> $account->status,
								'code'		=> $account->code,
								'hotel_id'  => $hotel->id,
								'hotel_name'=> $hotel->name);
			
			$set = $this->session->set_userdata($user_data);
			//echo '<pre>';
			//var_dump($this->session->all_userdata());
			//print_r($this->session->userdata);
			redirect(site_url('dashboard'));
		}
	}

	function staff(){
		$data['title'] = 'Staff Giriş';
		$this->load->view('staff/login');
		//first destroy all session
		$this->session->sess_destroy();
	}

	function staff_post(){
		
		$username = $this->input->post('username');
		$pass = $this->input->post('password');


		if(empty($username)){
			$this->session->set_flashdata('error', 'Kullanıcı Kodunu Giriniz');
			redirect(site_url('login/staff'));
			die;
		}

		if(empty($pass)){
			$this->session->set_flashdata('error', 'Şifrenizi Giriniz!');
			redirect(site_url('login/staff'));
			die;
		}

		$this->load->model('staff_model');
		$account = $this->staff_model->check_staff($username,$pass);

		if(!$account){
			$this->session->set_flashdata('error', 'Kullanıcı Bilgileri Hatalı!');
			redirect(site_url('login/staff'));
		}else{

			$user_data =  array('staff_id'	=> $account->id,
								'name' 		=> $account->name,
								'surname'	=> $account->surname,
								'is_staff'	=> TRUE,
								'username'	=> $account->username);
			
			$this->session->set_userdata($user_data);
			echo '<pre>';
			print_r($this->session->userdata);
			//exit;
			redirect(site_url('staff'));
		}
	
	}

}