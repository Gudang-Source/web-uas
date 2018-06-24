<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_controller {
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		} else {
			$this->load->model('Pelanggan_model', 'Pelanggan');
		}
	}

    public function index() {
		
		$pelanggans = $this->Pelanggan->get_all_pelanggan();
		$page_title = 'Semua Pelanggan';
		$active_nav = 'pelanggan';
		$active_sub_nav = 'list_pelanggan';		
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/pelanggan/all', compact('pelanggans'));
		$this->load->view('back/after');
		
    }	

	public function add() {		
		
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
				
			$validation_cfg = $this->Pelanggan->get_validation_config();
			
			$this->form_validation->set_rules($validation_cfg);
			
			if($this->form_validation->run()) {
				$success_add = $this->Pelanggan->add_pelanggan();
				if($success_add) {
					$this->session->set_flashdata('alert', alert_success('Data pelanggan baru berhasil dibuat'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('Data pelanggan gagal dibuat'));					
				}
				redirect('admin/pelanggan', 'refresh');
			}
		}
		
		
		$this->load->model('Identitas_model');
		$identitas = $this->Identitas_model->get_all_identitas();
		
		$page_title = 'Tambah Pelanggan';
		$active_nav = 'pelanggan';
		$active_sub_nav = 'add_pelanggan';
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/pelanggan/add', compact('identitas'));
		$this->load->view('back/after');
		
	}
	
	
	
	public function edit($id = NULL) {
		if(!$id) {
			redirect('admin/pelanggan', 'refresh');
		}
		
		$pelanggan = $this->Pelanggan->get_pelanggan_by_id($id);
		
		if(empty($pelanggan)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data yang akan diedit'));
			redirect('admin/pelanggan/index', 'refresh');	
		} else {
			
			$errors = '';
			
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$validation_cfg = $this->Pelanggan->get_validation_config();
				
				if($this->input->post('no_hp') == $pelanggan->no_hp) {
					$validation_cfg['no_hp']['rules'] = 'trim|required|xss_clean';		
				}
				
				if(strtolower($this->input->post('email')) == strtolower($pelanggan->email)) {
					$validation_cfg['email']['rules'] = 'trim|required|xss_clean|valid_email';				
				}				
				
				$this->form_validation->set_rules($validation_cfg);
				
				if($this->form_validation->run()) {
					$success_edit = $this->Pelanggan->update_pelanggan_by_id($id);
					if($success_edit) {
						$this->session->set_flashdata('alert', alert_success('Data pelanggan berhasil diedit'));					
					} else {
						$this->session->set_flashdata('alert', alert_error('Data pelanggan gagal diedit'));					
					}
					redirect('admin/pelanggan', 'refresh');
				}
			}
			
			$page_title = 'Edit Pelanggan';
			$this->load->model('Identitas_model');
			$identitas = $this->Identitas_model->get_all_identitas();
			
			$active_nav = 'pelanggan';
			
			$this->load->view('back/before', compact('page_title', 'active_nav'));
			$this->load->view('back/pelanggan/edit', compact('pelanggan', 'identitas'));
			$this->load->view('back/after');
			
		}
	}
	
	public function del($id = NULL) {
		if(!$id) {
			redirect('admin/pelanggan', 'refresh');
		}
		
		$result = $this->Pelanggan->get_pelanggan_by_id($id);
		
		if(empty($result)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data yang akan dihapus'));			
		} else {
			$result = $this->Pelanggan->delete_pelanggan_by_id($id);
			if($result) {
				$this->session->set_flashdata('alert', alert_success('Data telah sukses dihapus'));
			} else {
				$this->session->set_flashdata('alert', alert_success('Data ternyata gagal dihapus'));
			}			
		}
		
		redirect('admin/pelanggan', 'refresh');		
		
	}


}
