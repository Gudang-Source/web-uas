<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identitas extends CI_controller {
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		} else {
			$this->load->model('Identitas_model', 'Identitas');
		}
	}

    public function index() {
		
		$identitases = $this->Identitas->get_all_identitas();
		$page_title = 'Jenis Identitas';
		$active_nav = 'data_master';
		$active_sub_nav = 'identitas';		
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/identitas/all', compact('identitases'));
		$this->load->view('back/after');	
		
    }
	
	public function add() {
		
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$validation_cfg = $this->Identitas->get_validation_config();
			
			$this->form_validation->set_rules($validation_cfg);			
				
			if($this->form_validation->run()) {
				$success_add = $this->Identitas->add_identitas();
				if($success_add) {
					$this->session->set_flashdata('alert', alert_success('Data identitas baru berhasil dibuat'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('Data identitas gagal dibuat'));					
				}
				redirect('admin/identitas', 'refresh');
			}
		}
		
		$identitases = $this->Identitas->get_all_identitas();
		$page_title = 'Jenis Identitas';
		$active_nav = 'data_master';
		$active_sub_nav = 'identitas';		
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/identitas/add');
		$this->load->view('back/after');
		
	}
	
	public function edit($id = NULL) {
		if(!$id) {
			redirect('admin/identitas', 'refresh');
		}
		
		$result = $this->Identitas->get_identitas_by_id($id);
		if(empty($result)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data yang akan diedit'));
			redirect('admin/identitas', 'refresh');
		} else {			
		
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				$validation_cfg = $this->Identitas->get_validation_config();
				
				if(strtolower($this->input->post('jenis_identitas')) == strtolower($result->jenis_identitas)) {
				  $validation_cfg['jenis_identitas']['rules'] = 'trim|required|xss_clean';
				}
				
				$this->form_validation->set_rules($validation_cfg);
				
				if($this->form_validation->run()) {
					$success_edit = $this->Identitas->update_identitas_by_id($id);
					if($success_edit) {
						$this->session->set_flashdata('alert', alert_success('Data identitas berhasil diedit'));					
					} else {
						$this->session->set_flashdata('alert', alert_error('Data identitas gagal diedit'));					
					}
					redirect('admin/identitas', 'refresh');
				}
			}			
			
			$page_title = 'Jenis Identitas';
			$active_nav = 'data_master';
			$active_sub_nav = 'identitas';		
			
			$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
			$this->load->view('back/identitas/edit', compact('result'));
			$this->load->view('back/after');
			
			
			
		}
	}
	
	public function del($id = NULL) {
		if(!$id) {
			redirect('admin/identitas', 'refresh');
		}
		
		$result = $this->Identitas->get_identitas_by_id($id);
		
		if(empty($result)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data yang akan dihapus'));			
		} else {
			$result = $this->Identitas->delete_identitas_by_id($id);
			if($result) {
				$this->session->set_flashdata('alert', alert_success('Data telah sukses dihapus'));
			} else {
				$this->session->set_flashdata('alert', alert_success('Data ternyata gagal dihapus'));
			}			
		}
		
		redirect('admin/identitas', 'refresh');		
		
	}

}
