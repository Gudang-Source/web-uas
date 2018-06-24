<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_controller {
	
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		} else {
			$this->load->model('Transaksi_model', 'Transaksi');
		}
	}

    public function index() {
		
		
    }	


}