<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prod extends CI_controller {
	
	public function __construct() {
		parent::__construct();		
		$this->load->model('Kategori_model', 'Kategori');
		$this->load->model('Produk_model', 'Produk');
	}

    public function index($id = NULL) {
		
		if(!$id) {
			redirect('home', 'refresh');
		}
		
		$produk = $this->Produk->get_by_id_with_catname($id);
		if(empty($produk)) {
			redirect('home', 'refresh');
		}
		
		$page_title = $produk->nama_produk;
		$active_nav = '';	
		
		$cat_tree = $this->Kategori->get_cat_tree();		
		$this->load->view('front/before', compact('page_title', 'active_nav', 'cat_tree'));		
		$this->load->view('front/produk', compact('produk'));
		$this->load->view('front/after');
		
    }

}