<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_controller {
	
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		} else {
			$this->load->model('Produk_model', 'Produk');
			$this->load->model('Kategori_model', 'Kategori');
		}
	}

    public function index() {		
		$produks = $this->Produk->get_all();
		
		$page_title = 'List Produk';
		$active_nav = 'produk';
		$active_sub_nav = 'list_produk';
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/produk/all', compact('produks'));
		$this->load->view('back/after');
		
    }
	
	public function add() {

		if($_SERVER['REQUEST_METHOD'] == 'POST') {			
			
			$this->form_validation->set_rules($this->Produk->get_validation_config());
			
			if($this->form_validation->run()) {				
				$success_add = $this->Produk->add_new();
				if($success_add) {
					$this->session->set_flashdata('alert', alert_success('Produk baru berhasil dibuat'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('Produk baru gagal dibuat'));					
				}
				redirect('admin/produk', 'refresh');
			}
		}
		
		$page_title = 'Tambah Produk';
		$active_nav = 'produk';
		$active_sub_nav = 'add_produk';		
		
		$cats = $this->Kategori->get_cat_tree();
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/produk/add', compact('cats'));
		$this->load->view('back/after');
		
	}
	
	public function edit($id = NULL) {
		
		if(!$id) {
			redirect('admin/produk', 'refresh');
		}
		
		$produk = $this->Produk->get_by_id($id);
		if(empty($produk)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data yang akan diedit'));
			redirect('admin/produk', 'refresh');
		}
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {			
			
			$this->form_validation->set_rules($this->Produk->get_validation_config());
			
			if($this->form_validation->run()) {				
				$success_edit = $this->Produk->update_by_id($id);
				if($success_edit) {
					$this->session->set_flashdata('alert', alert_success('Produk berhasil diedit'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('Produk gagal diedit'));					
				}
				redirect('admin/produk', 'refresh');
			}
		}
		
		$page_title = 'Edit Produk';
		$active_nav = 'produk';		
		$cats = $this->Kategori->get_cat_tree();
		$this->load->view('back/before', compact('page_title', 'active_nav'));
		$this->load->view('back/produk/edit', compact('produk', 'cats'));
		$this->load->view('back/after');
		
	}
	
	public function del($id = NULL) {
		
		if(!$id) {
			redirect('admin/produk', 'refresh');
		}
		
		$produk = $this->Produk->get_by_id($id);
		
		if(empty($produk)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya produk yang akan dihapus'));			
		} else {
			$result = $this->Produk->delete_by_id($id);
			if($result) {
				$this->session->set_flashdata('alert', alert_success('Produk telah sukses dihapus'));
			} else {
				$this->session->set_flashdata('alert', alert_success('Produk ternyata gagal dihapus'));
			}			
		}
		
		redirect('admin/produk', 'refresh');		
	}

}