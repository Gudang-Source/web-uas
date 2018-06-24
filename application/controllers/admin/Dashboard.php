<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_controller {
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		}		
	}

    public function index() {        
		redirect('admin/user/detail/'.$this->session->user_id);	
    }	
	
}
