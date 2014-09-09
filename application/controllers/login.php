<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index()
	{	
		$data['title'] = 'Login';
		$this->load->view('login');
	}

	function post(){
		$code = $this->input->post('code');
		$pass = $this->input->post('password');

		$this->load->model('login_model');
		$account = $this->login_model->chec_account($code,$pass);

		$redirect = $this->input->post('redirect');
		$reurl = isset($redirect) ? site_url($redirect) : site_url('login');

		if(empty($code)){
			$this->session->set_flashdata('error', 'Kullanıcı Kodunu Giriniz');
			redirect($reurl);
			exit;
		}

		if(empty($pass)){
			$this->session->set_flashdata('error', 'Şifrenizi Giriniz!');
			exit;
		}

		if(!$account){
			$this->session->set_flashdata('error', 'Kullanıcı Bilgileri Hatalı!');
			redirect($reurl);
		}else{

			$hotel_id  = $this->login_model->default_hotel($check->code);
			$user_data =  array('name' 		=> $check->name,
								'surname'	=> $check->surname,
								'username' 	=> $check->username,
								'status'	=> $check->status,
								'hotel_id'  => $hotel_id);
			
			$this->session->set_userdata($user_data);

			redirect($reurl);
		}
	}

}