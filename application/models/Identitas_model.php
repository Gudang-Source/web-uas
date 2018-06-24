<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identitas_model extends CI_model {
	
	protected $table = 'identitas';
	
	public function get_validation_config() {
		$validation_cfg = array(
			'jenis_identitas' => array(
				'field' => 'jenis_identitas',
				'label' => 'Jenis Identitas',
				'rules' => 'trim|required|is_unique['.$this->table.'.jenis_identitas]|xss_clean',					
			)
		);
		return $validation_cfg;
	}
	
	public function get_all_identitas() {	
		
		$result_set = $this->db->get($this->table);		
		return $result_set->result_array();
		
	}
	
	public function add_identitas() {
		$jenis_identitas = $this->input->post('jenis_identitas');
		return $this->db->insert($this->table, compact('jenis_identitas'));
	}
	
	public function get_identitas_by_id($id) {
		
		$result_set = $this->db->get_where($this->table, compact('id'));		
		return $result_set->row();
		
	}
	
	public function update_identitas_by_id($id) {
		
		$jenis_identitas = $this->input->post('jenis_identitas');
		return $this->db->where('id', $id)->update($this->table, compact('jenis_identitas'));
		
	}
	
	
	public function delete_identitas_by_id($id) {
		
		return $this->db->delete('identitas', compact('id'));
		
	}
	
}