<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_model {
	
	protected $table = 'produk';	
	protected $table_cat = 'kategori';	
	protected $table_produk_to_cat = 'produk_to_kategori';	
	
	public function get_validation_config() {
		$validation_cfg = array(
			array(
				'field' => 'nama_produk',
				'label' => 'Nama Produk',
				'rules' => 'trim|required|xss_clean',					
			),
			array(
				'field' => 'description',
				'label' => 'Deskripsi Produk',
				'rules' => 'trim|xss_clean',					
			),
			array(
				'field' => 'total_stock',
				'label' => 'Total Stock',
				'rules' => 'trim|xss_clean|is_natural',	
			),
			array(
				'field' => 'ready_stock',
				'label' => 'Ready Stock',
				'rules' => 'trim|xss_clean|is_natural',	
			),
			array(
				'field' => 'harga_sewa',
				'label' => 'Harga Sewa',
				'rules' => 'trim|xss_clean|required|is_natural_no_zero',	
			),
			array(
				'field' => 'kategori',
				'label' => 'Kategori',
				'rules' => 'trim|xss_clean|is_natural',	
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
	
	public function get_product_photo($id) {
		$user = $this->get_by_id($id);
		return $user->foto;
	}
	
	public function get_all() {		
		$this->db->select(
					'prd.*, 
					GROUP_CONCAT(cat.nama_kategori SEPARATOR \', \') AS nama_cats'					
				);
		$this->db->from($this->table.' prd');		
		$this->db->join($this->table_produk_to_cat.' p2c', 'prd.id = p2c.id_produk', 'left');		
		$this->db->join($this->table_cat.' cat', 'cat.id = p2c.id_kategori', 'left');		
		$this->db->group_by('prd.id');
		$this->db->order_by('prd.nama_produk', 'ASC');
		$result_set = $this->db->get();		
		return $result_set->result_array();
	}
	
	public function get_product_by_cat($cat_id) {
		
		$this->db->select(
					'prd.*,					
					GROUP_CONCAT(cat.id) AS id_cats'
				);
		$this->db->from($this->table.' prd');
		$this->db->join($this->table_produk_to_cat.' p2c', 'prd.id = p2c.id_produk', 'left');		
		$this->db->join($this->table_cat.' cat', 'cat.id = p2c.id_kategori', 'left');		
		$this->db->group_by('prd.id');
		$this->db->where('p2c.id_kategori', $cat_id);
		$result_set = $this->db->get();
		
		return $result_set->result_array();	
		
	}
	
	
	public function add_new() {
		$nama_produk = $this->input->post('nama_produk');		
		$description = $this->input->post('description');
		$total_stock = $this->input->post('total_stock');
		$ready_stock = $total_stock;
		$harga_sewa = $this->input->post('harga_sewa');
		$categories = $this->input->post('kategori');

		$foto = NULL;
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$foto = $this->do_upload();
		}		
		
		$success_add = $this->db->insert($this->table, compact('nama_produk', 'description', 'total_stock', 'ready_stock', 'harga_sewa', 'foto'));		
		
		if(!empty($categories) && $success_add) {			
			$id_produk = $this->db->insert_id();			
			foreach($categories as $id_kategori) {
				$this->db->insert($this->table_produk_to_cat, compact('id_produk', 'id_kategori'));
			}
		}
		return $success_add;
	}
	
	public function get_by_id($id) {

		$this->db->select(
					'prd.*,					
					GROUP_CONCAT(cat.id) AS id_cats'
				);
		$this->db->from($this->table.' prd');
		$this->db->join($this->table_produk_to_cat.' p2c', 'prd.id = p2c.id_produk', 'left');		
		$this->db->join($this->table_cat.' cat', 'cat.id = p2c.id_kategori', 'left');		
		$this->db->group_by('prd.id');
		$this->db->where('prd.id', $id);
		$result_set = $this->db->get();
		
		return $result_set->row();		
	}
	
	public function get_by_id_with_catname($id) {

		$this->db->select(
					'prd.*,					
					GROUP_CONCAT(cat.nama_kategori SEPARATOR \', \') AS categories'
				);
		$this->db->from($this->table.' prd');
		$this->db->join($this->table_produk_to_cat.' p2c', 'prd.id = p2c.id_produk', 'left');		
		$this->db->join($this->table_cat.' cat', 'cat.id = p2c.id_kategori', 'left');		
		$this->db->group_by('prd.id');
		$this->db->where('prd.id', $id);
		$result_set = $this->db->get();
		
		return $result_set->row();		
	}
	
	public function update_by_id($id) {	

		$nama_produk = $this->input->post('nama_produk');		
		$description = $this->input->post('description');
		$total_stock = $this->input->post('total_stock');
		$harga_sewa = $this->input->post('harga_sewa');
		$categories = $this->input->post('kategori');
		
		$updated_data = compact('nama_produk', 'description', 'total_stock', 'harga_sewa');
		
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$updated_data['foto'] = $this->do_upload();
			
			$old_foto = $this->get_product_photo($id);
			if($old_foto) {
				unlink('./uploads/'.$old_foto);
			}			
		}
	
		$success_edit = $this->db->where('id', $id)->update($this->table, $updated_data);
		
		if($success_edit) {
			$id_produk = $id;
			$this->db->delete($this->table_produk_to_cat, compact('id_produk'));
			if(!empty($categories)) {				
				foreach($categories as $id_kategori) {
					$this->db->insert($this->table_produk_to_cat, compact('id_produk', 'id_kategori'));
				}
			}
		}

		return $success_edit;
	}
	
	
	public function delete_by_id($id) {
		$old_foto = $this->get_product_photo($id);
		if($old_foto) {
			unlink('./uploads/'.$old_foto);
		}
		
		return $this->db->delete($this->table, compact('id'));		
	}
	
	public function produk_disewa($id, $qty) {
		$this->db->set('ready_stock', 'ready_stock - '.$qty, FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table); 
	}
	
	public function produk_dikembalikan($id, $qty) {
		$this->db->set('ready_stock', 'ready_stock + '.$qty, FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table); 
	}
	
	public function update_ready_stock() {
		$this->load->model('Transaksi_model', 'Transaksi');
		$produks = $this->get_all();
		foreach($produks as $produk) {
			$total_qty = $this->Transaksi->get_all_qty_by_produk($produk['id']);			
			$ready_stock = $produk['total_stock'] - $total_qty;
			$this->db->set('ready_stock', $ready_stock);
			$this->db->where('id', $produk['id']);
			$this->db->update($this->table); 			
		}
		
		
	}
	
}