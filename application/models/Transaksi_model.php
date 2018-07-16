<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_model {
	
	public $table = 'sewa';
	public $table_detail_sewa = 'detail_sewa';
	public $table_produk = 'produk';
	
	public function get_validation_config() {
		$validation_cfg = array(			
			'id_produk' => array(
				'field' => 'id_produk',
				'label' => 'Produk',
				'rules' => 'trim|required|xss_clean|is_natural_no_zero',					
			),			
			'lama_sewa' => array(
				'field' => 'lama_sewa',
				'label' => 'Lama Sewa',
				'rules' => 'trim|xss_clean|required|is_natural_no_zero',					
			),
			'qty' => array(
				'field' => 'qty',
				'label' => 'Kuantitas',
				'rules' => 'trim|xss_clean|required|is_natural_no_zero',					
			),			
		);
		return $validation_cfg;
	}
	
	public function get_transaksi($id) {		
		$result_set = $this->db->get_where($this->table, compact('id'));
		$result = $result_set->row_array();
		if(!empty($result)) {
			$result = array_merge($result, array('items' => $this->get_detail_transaksi($id)));	
			
			if($result['dikembalikan']) {
				$result['status'] = 'Sudah Dikembalikan';				
			} else {
				$result['status'] = 'Belum Dikembalikan';
				$diff = date_diff(date_create($result['jadwal_kembali']), date_create(date('Y-m-d')));
				$terlambat = $diff->format("%r%a");
				if($terlambat > 0) {
					$result['status'] .= '<br><strong class="col-pink">Terlambat '.$terlambat.' hari!</strong>';
					$result['denda'] = $this->update_denda_by_id($result['id'], $result, $terlambat);
				}
			}
			
		}
		return $result;
	}
	
	public function get_all_transaksi() {
		$transaksis = array();		
		$this->db->select('*')->order_by('tgl_sewa', 'DESC');
		$result_set = $this->db->get($this->table);
		$temp_results = $result_set->result_array();
		$results = array();
		if(!empty($temp_results)): foreach($temp_results as $i => $res):
			
			$results[$i] = $res;
			if($results[$i]['tgl_kembali'] == '0000-00-00') {
				$results[$i]['tgl_kembali'] = '-';
			}
			if($res['dikembalikan']) {
				$results[$i]['status'] = 'Sudah Dikembalikan';				
			} else {
				$results[$i]['status'] = 'Belum Dikembalikan';				
				$terlambat = $this->get_keterlambatan($res['id']);
				if($terlambat > 0) {
					$results[$i]['status'] .= '<br><strong class="col-pink">Terlambat '.$terlambat.' hari!</strong>';
					$results[$i]['denda'] = $this->update_denda_by_id($res['id']);
				}
			}
			
		endforeach; endif;
		
		return $results;
		
	}
	
	public function get_transaksi_by_pelanggan($id_pelanggan) {		
		$result_set = $this->db->order_by('tgl_sewa', 'DESC')->get_where($this->table, compact('id_pelanggan'));
		$temp_results = $result_set->result_array();
		$results = array();
		if(!empty($temp_results)): foreach($temp_results as $i => $res):
			
			$results[$i] = $res;
			if($results[$i]['tgl_kembali'] == '0000-00-00') {
				$results[$i]['tgl_kembali'] = '-';
			}
			if($res['dikembalikan']) {
				$results[$i]['status'] = 'Sudah Dikembalikan';				
			} else {
				$results[$i]['status'] = 'Belum Dikembalikan';				
				$terlambat = $this->get_keterlambatan($res['id']);
				if($terlambat > 0) {
					$results[$i]['status'] .= '<br><strong class="col-pink">Terlambat '.$terlambat.' hari!</strong>';
					$results[$i]['denda'] = $this->update_denda_by_id($res['id']);
				}
			}
			
		endforeach; endif;
		
		return $results;
	}
	
	public function get_detail_transaksi($id_sewa) {
		$this->db->select(
					'dtl.*,					
					prd.nama_produk'
				);
		$this->db->from($this->table_detail_sewa.' AS dtl');
		$this->db->join($this->table_produk.' AS prd', 'prd.id = dtl.id_produk', 'left');		
		$this->db->where('dtl.id_sewa', $id_sewa);
		$result_set = $this->db->get();		
		return $result_set->result_array();
	}
	
	public function get_lama_sewa($id) {
		$transaksi = $this->get_transaksi($id);
		return $transaksi['lama_sewa'];		
	}
	
	public function get_keterlambatan($id) {
		$transaksi = $this->get_transaksi($id);
		$diff = date_diff(date_create($transaksi['jadwal_kembali']), date_create(date('Y-m-d')));
		return $diff->format("%r%a");
	}
	
	public function update_denda_by_id($id, $transaksi = false, $terlambat = false) {
		if(!$transaksi && !$terlambat) {
			$transaksi = $this->get_transaksi($id);
			$terlambat = $this->get_keterlambatan($id);
		}
		$denda = 0;
		if($terlambat > 0) {
			$denda = $terlambat * $transaksi['biaya_per_hari'];
			$this->db->set('denda', $denda);
			$this->db->where('id', $id);
			$this->db->update($this->table); 
		}
		return $denda;
	}
	
	
	public function kembalikan_sewa($id) {		
		$dikembalikan = 1;
		$tgl_kembali = date('Y-m-d');
		
		$updated_data = compact('dikembalikan', 'tgl_kembali');		

		$this->db->where('id', $id);
		$this->db->update($this->table, $updated_data); 
	}
	

	public function add_new($id_pelanggan) {
		
		$id_petugas = $this->session->user_id;
		$lama_sewa = $this->input->post('lama_sewa');
		$id_produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		$tgl_sewa = date('Y-m-d');
		$jadwal_kembali = date('Y-m-d', strtotime('+'.$lama_sewa.' day'));
		
		
		$this->load->model('Produk_model', 'Produk');
		$produk_disewa = $this->Produk->get_by_id($id_produk);		
		
		$biaya_per_hari = $produk_disewa->harga_sewa * $qty;
		$biaya_total = $biaya_per_hari * $lama_sewa;
		
		if($qty > $produk_disewa->ready_stock) {
			return false;
		} else {
			$success_add = $this->db->insert($this->table, compact('id_pelanggan', 'tgl_sewa', 'lama_sewa', 'jadwal_kembali', 'biaya_per_hari', 'biaya_total', 'id_petugas'));		
			if($success_add) {
				$id_sewa = $this->db->insert_id();
				$this->db->insert($this->table_detail_sewa, compact('id_sewa', 'id_produk', 'qty', 'biaya_per_hari'));				
				$this->Produk->produk_disewa($id_produk, $qty);				
				return $id_sewa;
				
			} else {
				return false;
			}		
		}		
		
	}
	
	public function update_by_id($id) {		
		$tgl_sewa = $this->input->post('tgl_sewa');		
		$lama_sewa = $this->input->post('lama_sewa');
		$jadwal_kembali = date('Y-m-d', strtotime($tgl_sewa .' +'.$lama_sewa.' day'));		
		$updated_data = compact('tgl_sewa', 'lama_sewa', 'jadwal_kembali');		
		$success_edit = $this->db->where('id', $id)->update($this->table, $updated_data);
		$this->update_biaya_total($id);
		
		return $success_edit;
	}
	
	public function tambah_biaya_total($id, $biaya) {
		$this->db->set('biaya_total', 'biaya_total + '.$biaya, FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table); 
	}
	
	public function update_biaya_total($id_sewa) {
		
		$lama_sewa = $this->get_lama_sewa($id_sewa);
		
		$this->db->select_sum('biaya_per_hari');
		$this->db->where('id_sewa', $id_sewa);
		$result = $this->db->get($this->table_detail_sewa);
		$jml_harga = $result->row();
		$jml_harga = $jml_harga->biaya_per_hari;
		
		$total_jendral = $jml_harga * $lama_sewa;
		
		$this->db->set('biaya_total', $total_jendral);
		$this->db->where('id', $id_sewa);
		$this->db->update($this->table); 
	}
	
	public function get_item($id) {
		$result_set = $this->db->get_where($this->table_detail_sewa, compact('id'));
		$result = $result_set->row();		
		return $result;
	}
	
	public function add_new_item($id_sewa) {
		
		$id_produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');		
		
		$this->load->model('Produk_model', 'Produk');
		$produk_disewa = $this->Produk->get_by_id($id_produk);		
		
		$biaya_per_hari = $produk_disewa->harga_sewa * $qty;
		$biaya_total = $biaya_per_hari * $this->get_lama_sewa($id_sewa);
		
		if($qty > $produk_disewa->ready_stock) {
			return false;
		} else {			
			$result = $this->db->insert($this->table_detail_sewa, compact('id_sewa', 'id_produk', 'qty', 'biaya_per_hari'));
			$this->update_biaya_total($id_sewa);
			$this->Produk->produk_disewa($id_produk, $qty);			
			return $result;
		}		
		
	}
	
	public function edit_item($id, $id_sewa) {
		
		$id_produk = $this->input->post('id_produk');
		$qty = $this->input->post('qty');
		
		$this->db->set('qty', 0);
		$this->db->where('id', $id);
		$this->db->update($this->table_detail_sewa);
		
		$this->load->model('Produk_model', 'Produk');
		$this->Produk->update_ready_stock();
		
		$produk_disewa = $this->Produk->get_by_id($id_produk);		
		
		$biaya_per_hari = $produk_disewa->harga_sewa * $qty;		
		
		if($qty > $produk_disewa->ready_stock) {
			return false;
		} else {
			
			$updated_data = compact('id_sewa', 'id_produk', 'qty', 'biaya_per_hari');			
			$result = $this->db->where('id', $id)->update($this->table_detail_sewa, $updated_data);
			$this->update_biaya_total($id_sewa);
			$this->Produk->update_ready_stock();
			
			return $result;
		}		
		
	}
	
	public function del_item($id, $id_sewa) {
		$result = $this->db->delete($this->table_detail_sewa, compact('id'));
		$this->update_biaya_total($id_sewa);
		$this->load->model('Produk_model', 'Produk');
		$this->Produk->update_ready_stock();
		return $result;
	}
	
	public function del_transaksi($id) {
		$result = $this->db->delete($this->table, compact('id'));
		$this->load->model('Produk_model', 'Produk');
		$this->Produk->update_ready_stock();
		return $result;
	}
	
	public function get_all_qty_by_produk($id_produk) {		
		$this->db->select_sum('qty');
		$this->db->where('id_produk', $id_produk);
		$result = $this->db->get($this->table_detail_sewa);
		$qty = $result->row();
		$qty = $qty->qty;		
		return $qty;		
	}
	
}