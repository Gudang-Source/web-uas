<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_controller {
	
	public function __construct() {
		parent::__construct();		
		$this->load->model('Dashboard_model', 'model_dashboard');
	}

    public function index() {
		if(!empty($this->session->user_id)) {
			redirect('admin/dashboard');
		}
        $this->load->view('back/login');
    }
	
	public function auth() {
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
	
		$password = hash('sha256', $password);
		
		$profile = $this->model_dashboard->get_profile_by_login($username, $password);
		
		if($profile) {
			
			$profile_data = array(
				'username' => $profile->username,
				'nama' => $profile->nama,
				'email' => $profile->email,
				'foto' => $profile->foto,
			);
			
			$this->session->set_userdata('user_id', $profile->id);
			$this->session->set_userdata('user_role', $profile->role);
			$this->session->set_userdata('profile', $profile_data);
			redirect('admin/dashboard');
			
		} else {
			$this->session->set_flashdata('error_msg', 'Username / Password tidak cocok');
			redirect('login');
		}
		
	}
	
	public function logout() {		
		$this->session->sess_destroy();
		redirect('login');
	}

}
