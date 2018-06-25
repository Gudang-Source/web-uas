<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_controller {
	
	public function __construct() {
		parent::__construct();		
		$this->load->model('Kategori_model', 'Kategori');
	}

    public function index() {
		
		$page_title = 'Home Page';
		$active_nav = '';

		$welcome_msg = '<h1 class="title">Selamat Datang di Rental Alat Camping UMBY</h1>';
		$welcome_msg .= '<p>Ini adalah suatu aplikasi manajemen persewaan alat-alat camping.</p>';
		
		$cat_tree = $this->Kategori->get_cat_tree();
		
		$this->load->view('front/before', compact('page_title', 'active_nav', 'cat_tree'));		
		$this->load->view('front/home', compact('welcome_msg'));
		$this->load->view('front/after');
		
    }

}