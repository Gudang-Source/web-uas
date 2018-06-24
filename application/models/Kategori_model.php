<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_model {
	
	protected $table = 'kategori';	
	
	public function get_validation_config() {
		$validation_cfg = array(	
			'nama_kategori' => array(
				'field' => 'nama_kategori',
				'label' => 'Nama Kategori',
				'rules' => 'trim|required|xss_clean',					
			),
			'parent' => array(
				'field' => 'parent',
				'label' => 'Parent Kategori',
				'rules' => 'trim|xss_clean|is_natural',					
			),		
		);
		return $validation_cfg;
	}	
	
	/*
	public function get_all() {		
		$this->db->select('C.*');
		$this->db->from($this->table.' C');
		$this->db->join($this->table.' P', 'P.id = C.parent', 'left');
		$this->db->order_by('IF(P.id, P.nama_kategori, C.nama_kategori), P.nama_kategori, C.nama_kategori');
		$result_set = $this->db->get();
		return $result_set->result_array();		
	}
	*/
	
	public function get_all() {		
		return $this->get_sub_cats(0);		
	}
	
	public function get_all_exclude($exclude = false) {		
		return $this->get_sub_cats(0, $exclude);		
	}
	
	public function get_sub_cats($parent = 0, $exclude = false) {		

		$this->db->order_by('nama_kategori');
		$result_set = $this->db->get_where($this->table, compact('parent'));
		$categories = $result_set->result_array();
		$all_cats = array();
		if(!empty($categories)) {
			foreach($categories as $p_cat) {
				if($exclude != $p_cat['id']) {
					$all_cats[] = $p_cat;
					$sub_cats = $this->get_sub_cats($p_cat['id'], $exclude);
					if(!empty($sub_cats)){
						$all_cats = array_merge($all_cats, $sub_cats);
					}
				}
			}
		}
		
		return $all_cats;
		
	}
	
	public function get_cat_tree($parent_id = 0) {
		
		$parent = $parent_id;
		$this->db->order_by('nama_kategori');
		$result_set = $this->db->get_where($this->table, compact('parent'));
		$categories = $result_set->result_array();
		
		if(!empty($categories)) {
			foreach($categories as $idx => $p_cat) {				
				$sub_cats = $this->get_cat_tree($p_cat['id']);
				if(!empty($sub_cats)){
					$categories[$idx]['sub'] = $this->get_cat_tree($p_cat['id']);
				}
			}
		}
		
		return $categories;
		
	}	
	
	public function add_new() {
		$nama_kategori = $this->input->post('nama_kategori');		
		$parent = $this->input->post('parent');		
		return $this->db->insert($this->table, compact('nama_kategori', 'parent'));
	}
	
	public function get_by_id($id) {		
		$result_set = $this->db->get_where($this->table, compact('id'));		
		return $result_set->row();		
	}
	
	public function update_by_id($id) {		
		$nama_kategori = $this->input->post('nama_kategori');
		$parent = $this->input->post('parent');		
		return $this->db->where('id', $id)->update($this->table, compact('nama_kategori', 'parent'));		
	}
	
	
	public function delete_by_id($id) {
		$this->db->where('parent', $id)->update($this->table, array('parent' => 0));
		return $this->db->delete($this->table, compact('id'));		
	}
	
}