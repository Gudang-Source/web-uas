<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {
	
	public $table_user = 'user';
	public $table_role = 'user_role';
	
	public function get_validation_config() {
		$validation_cfg = array(	
			'username' => array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|xss_clean|is_unique['.$this->table_user.'.username]',					
			),
			'password' => array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required',					
			),
			'retype_password' => array(
				'field' => 'retype_password',
				'label' => 'Konfirmasi Password',
				'rules' => 'trim|required|matches[password]',					
			),	
			array(
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'trim|required|xss_clean',					
			),
			'email' => array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|xss_clean|valid_email|is_unique['.$this->table_user.'.email]',					
			),		
			array(
				'field' => 'role',
				'label' => 'Role',
				'rules' => 'trim|required|xss_clean|is_natural_no_zero',
				'errors' => array(
					'required' => '%s harus dipilih',						
				)					
			),		
			
		);

		return $validation_cfg;
	}
	
	public function do_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$this->upload->do_upload('foto');
		$data = $this->upload->data();
		return $data['file_name'];
	}
	
	public function get_user_photo($id) {
		$user = $this->get_by_id($id);
		return $user->foto;
	}
	
	public function get_all() {
		$this->db->select($this->table_user.'.*, '.$this->table_role.'.nama_role');
		$this->db->from($this->table_user);
		$this->db->join($this->table_role, $this->table_role.'.id_role = '.$this->table_user.'.id_role');
		$result_set = $this->db->get();
		return $result_set->result_array();		
	}
	
	public function get_all_role() {
		$result_set = $this->db->get($this->table_role);
		return $result_set->result_array();		
	}
	
	public function add_new() {
		$username = $this->input->post('username');
		$password = hash('sha256', $this->input->post('password'));
		$nama = $this->input->post('nama');		
		$email = $this->input->post('email');
		$id_role = $this->input->post('role');
		$foto = NULL;
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$foto = $this->do_upload();
		}		
		
		return $this->db->insert($this->table_user, compact('username', 'password', 'nama', 'email', 'id_role', 'foto'));
	}
	
	public function get_by_id($id) {
		
		$this->db->select($this->table_user.'.*, '.$this->table_role.'.nama_role');
		$this->db->from($this->table_user);
		$this->db->join($this->table_role, $this->table_role.'.id_role = '.$this->table_user.'.id_role');
		$this->db->where($this->table_user.'.id', $id);
		$result_set = $this->db->get();		
		return $result_set->row();
		
	}
	
	public function update_by_id($id) {
		
		$username = $this->input->post('username');
		$nama = $this->input->post('nama');		
		$email = $this->input->post('email');
		$id_role = $this->input->post('role');
		$password = $this->input->post('password');
		
		$updated_data = compact('username', 'nama', 'email', 'id_role');
		
		if($password) {
			$updated_data['password'] = hash('sha256', $password);
		}
		
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$updated_data['foto'] = $this->do_upload();
			
			$old_foto = $this->get_user_photo($id);
			if($old_foto) {
				unlink('./uploads/'.$old_foto);
			}
			
		}
		
		return $this->db->where('id', $id)->update($this->table_user, $updated_data);
		
	}
	
	
	public function delete_by_id($id) {
		
		$old_foto = $this->get_user_photo($id);
		if($old_foto) {
			unlink('./uploads/'.$old_foto);
		}
		
		return $this->db->delete($this->table_user, compact('id'));
		
	}
	
}