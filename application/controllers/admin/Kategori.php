<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_controller {
	
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		} else {
			$this->load->model('Kategori_model', 'Kategori');
		}
	}

    public function index() {		
		
		$cats = $this->Kategori->get_cat_tree();
		
		$page_title = 'List Kategori';
		$active_nav = 'data_master';
		$active_sub_nav = 'kategori';
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/kategori/all', compact('cats'));
		$this->load->view('back/after');
		
    }
	
	public function add() {		
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {			
			
			$this->form_validation->set_rules($this->Kategori->get_validation_config());
			
			if($this->form_validation->run()) {				
				$success_add = $this->Kategori->add_new();
				if($success_add) {
					$this->session->set_flashdata('alert', alert_success('Kategori baru berhasil dibuat'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('Kategori baru gagal dibuat'));					
				}
				redirect('admin/kategori', 'refresh');
			}
		}
		
		$all_cats = $this->Kategori->get_all();
		
		$page_title = 'Tambah Kategori';
		$active_nav = 'data_master';
		$active_sub_nav = 'kategori';
		
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/kategori/add', compact('all_cats'));
		$this->load->view('back/after');
		
	}
	
	public function edit($id = NULL) {
		
		if(!$id) {			
			redirect('admin/kategori', 'refresh');
		}
		
		$kategori = $this->Kategori->get_by_id($id);		
		
		if(empty($kategori)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data yang akan diedit'));
			redirect('admin/kategori', 'refresh');	
		}

		$all_cats = $this->Kategori->get_all_exclude($id);
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			$validation_cfg = $this->Kategori->get_validation_config();				
			
			$this->form_validation->set_rules($validation_cfg);
			
			if($this->form_validation->run()) {			
				
				$success_edit = $this->Kategori->update_by_id($id);
				if($success_edit) {
					$this->session->set_flashdata('alert', alert_success('Data kategori berhasil diedit'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('Data kategori gagal diedit'));					
				}
				redirect('admin/kategori', 'refresh');
				
			}
		}
		
		$page_title = 'Edit Kategori';
		$active_nav = 'kategori';		
		
		$this->load->view('back/before', compact('page_title', 'active_nav'));
		$this->load->view('back/kategori/edit', compact('kategori', 'all_cats'));
		$this->load->view('back/after');
		
	}
	
	public function del($id = NULL) {
		if(!$id) {
			redirect('admin/kategori', 'refresh');
		}
		
		$kategori = $this->Kategori->get_by_id($id);
		
		if(empty($kategori)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya kategori yang akan dihapus'));			
		} else {
			$result = $this->Kategori->delete_by_id($id);
			if($result) {
				$this->session->set_flashdata('alert', alert_success('Kategori telah sukses dihapus'));
			} else {
				$this->session->set_flashdata('alert', alert_success('Kategori ternyata gagal dihapus'));
			}			
		}
		
		redirect('admin/kategori', 'refresh');		
		
	}

}