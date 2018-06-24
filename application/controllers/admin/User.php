<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_controller {
	
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		} else {
			$this->load->model('User_model', 'User');
		}
	}

    public function index() {
		
		$users = $this->User->get_all();
		$page_title = 'List User';
		$active_nav = 'user';
		$active_sub_nav = 'list_user';
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/user/all', compact('users'));
		$this->load->view('back/after');
		
    }	
	
	public function detail($id = NULL) {
		if(!$id) {
			redirect('admin/user', 'refresh');
		}
		
		$user = $this->User->get_by_id($id);
		
		if(empty($user)) {			
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya user yang akan ditampilkan'));
			redirect('admin/user', 'refresh');			
		}

		$page_title = 'Detail User';
		$active_nav = 'user';
		
		$this->load->view('back/before', compact('page_title', 'active_nav'));
		$this->load->view('back/user/detail', compact('user'));
		$this->load->view('back/after');
		
	}
	
	public function add() {		
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {			
			
			$this->form_validation->set_rules($this->User->get_validation_config());
			
			if($this->form_validation->run()) {				
				$success_add = $this->User->add_new();
				if($success_add) {
					$this->session->set_flashdata('alert', alert_success('User baru berhasil dibuat'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('User baru gagal dibuat'));					
				}
				redirect('admin/user', 'refresh');
			}
		}
		
		$page_title = 'Tambah User';
		$active_nav = 'user';
		$active_sub_nav = 'add_user';
		
		$roles = $this->User->get_all_role();
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/user/add', compact('roles'));
		$this->load->view('back/after');
		
	}
	
	public function edit($id = NULL) {
		
		if(!$id) {			
			redirect('admin/user', 'refresh');
		}
		
		$user = $this->User->get_by_id($id);
		
		if(empty($user)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data yang akan diedit'));
			redirect('admin/user', 'refresh');	
		}		
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			$validation_cfg = $this->User->get_validation_config();
			
			$validation_cfg['password']['rules'] = 'trim';
			$validation_cfg['retype_password']['rules'] = 'trim|matches[password]';
			
			if(!$this->input->post('password') && !$this->input->post('retype_password')) {				
				$validation_cfg['retype_password']['rules'] = 'trim';
			}
			
			if($this->input->post('email') == $user->email) {				
				$validation_cfg['email']['rules'] = 'trim|required|xss_clean|valid_email';
			}
			if($this->input->post('username') == $user->username) {				
				$validation_cfg['username']['rules'] = 'trim|required|xss_clean';
			}	
			
			$this->form_validation->set_rules($validation_cfg);
			
			if($this->form_validation->run()) {			
				
				$success_edit = $this->User->update_by_id($id);
				if($success_edit) {
					$this->session->set_flashdata('alert', alert_success('Data user berhasil diedit'));					
				} else {
					$this->session->set_flashdata('alert', alert_error('Data user gagal diedit'));					
				}
				redirect('admin/user', 'refresh');
				
			}
		}
		
		$page_title = 'Edit User';
		$active_nav = 'user';
		
		$roles = $this->User->get_all_role();
		
		$this->load->view('back/before', compact('page_title', 'active_nav'));
		$this->load->view('back/user/edit', compact('user', 'roles'));
		$this->load->view('back/after');
		
	}
	
	public function del($id = NULL) {
		if(!$id) {
			redirect('admin/user', 'refresh');
		}
		
		$user = $this->User->get_by_id($id);
		
		if(empty($user)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya user yang akan dihapus'));
		} elseif($user->id == $this->session->user_id) {
			$this->session->set_flashdata('alert', alert_error('Maaf tidak dapat menghapus data anda sendiri'));
		} else {
			$result = $this->User->delete_by_id($id);
			if($result) {
				$this->session->set_flashdata('alert', alert_success('User telah sukses dihapus'));
			} else {
				$this->session->set_flashdata('alert', alert_success('User ternyata gagal dihapus'));
			}			
		}
		
		redirect('admin/user', 'refresh');		
		
	}

	


}
