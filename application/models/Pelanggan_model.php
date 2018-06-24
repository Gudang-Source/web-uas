<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_model {
	
	protected $table = 'pelanggan';
	protected $table_identitas = 'identitas';
	
	public function get_validation_config() {
		$validation_cfg = array(
			array(
				'field' => 'nama',
				'label' => 'Nama Pelanggan',
				'rules' => 'trim|required|xss_clean',					
			),
			array(
				'field' => 'no_identitas',
				'label' => 'No. Identitas',
				'rules' => 'trim|required|xss_clean',					
			),
			array(
				'field' => 'id_identitas',
				'label' => 'Jenis Identitas',
				'rules' => 'trim|required|xss_clean|is_natural_no_zero',
				'errors' => array(
					'required' => '%s harus dipilih',						
				)					
			),				
			array(
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'trim|required|xss_clean',					
			),
			'no_hp' => array(
				'field' => 'no_hp',
				'label' => 'No. HP',
				'rules' => 'trim|required|xss_clean|is_unique['.$this->table.'.no_hp]',					
			),
			'email' => array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|xss_clean|valid_email|is_unique['.$this->table.'.email]',					
			),
		);
		return $validation_cfg;
	}
	
	public function get_all_pelanggan() {	
		
		$this->db->select('pl.*, idt.jenis_identitas');
		$this->db->from($this->table.' pl');
		$this->db->join($this->table_identitas.' idt', 'pl.id_identitas = idt.id', 'left');
		$result_set = $this->db->get();		
		return $result_set->result_array();
		
	}
	
	public function add_pelanggan() {
		$nama = $this->input->post('nama');
		$no_identitas = $this->input->post('no_identitas');
		$id_identitas = $this->input->post('id_identitas');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		return $this->db->insert('pelanggan', compact('nama', 'no_identitas', 'id_identitas', 'alamat', 'no_hp', 'email'));
	}
	
	public function get_pelanggan_by_id($id) {
		
		$this->db->select('pelanggan.*, identitas.jenis_identitas');
		$this->db->from('pelanggan');
		$this->db->join('identitas', 'pelanggan.id_identitas = identitas.id');
		$this->db->where('pelanggan.id', $id);
		$result_set = $this->db->get();		
		return $result_set->row();
		
	}
	
	public function update_pelanggan_by_id($id) {
		
		$nama = $this->input->post('nama');
		$no_identitas = $this->input->post('no_identitas');
		$id_identitas = $this->input->post('id_identitas');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		
		return $this->db->where('id', $id)->update('pelanggan', compact('nama', 'no_identitas', 'id_identitas', 'alamat', 'no_hp', 'email'));
		
	}
	
	
	public function delete_pelanggan_by_id($id) {
		
		return $this->db->delete('pelanggan', compact('id'));
		
	}
	
}