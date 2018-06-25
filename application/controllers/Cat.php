<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat extends CI_controller {
	
	public function __construct() {
		parent::__construct();		
		$this->load->model('Kategori_model', 'Kategori');
		$this->load->model('Produk_model', 'Produk');
	}

    public function index($id = NULL) {
		
		if(!$id) {
			redirect('home', 'refresh');
		}
		
		$the_cat = $this->Kategori->get_by_id($id);
		if(empty($the_cat)) {
			redirect('home', 'refresh');
		}
		
		$page_title = 'Kategori: '.$the_cat->nama_kategori;
		$active_nav = '';		
		
		$produks = $this->Produk->get_product_by_cat($id);
		
		
		$cat_tree = $this->Kategori->get_cat_tree();		
		$this->load->view('front/before', compact('page_title', 'active_nav', 'cat_tree'));		
		$this->load->view('front/kategori', compact('produks'));
		$this->load->view('front/after');
		
    }

}