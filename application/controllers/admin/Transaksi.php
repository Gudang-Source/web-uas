<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_controller {
	
	
	public function __construct() {
		parent::__construct();
		
		if(empty($this->session->user_id)) {
			redirect('login');
		} else {
			$this->load->model('Transaksi_model', 'Transaksi');
			$this->load->model('Pelanggan_model', 'Pelanggan');
			$this->load->model('Produk_model', 'Produk');
		}
	}

    public function index() {
		
		
    }
	
	public function pelanggan($id_pelanggan) {
		
		if(!$id_pelanggan) {
			redirect('admin/transaksi', 'refresh');
		}
		
		$pelanggan = $this->Pelanggan->get_pelanggan_by_id($id_pelanggan);
		if(empty($pelanggan)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data transaksi'));
			redirect('admin/transaksi', 'refresh');	
		}
		
		$transaksis = $this->Transaksi->get_transaksi_by_pelanggan($id_pelanggan);
		
		$page_title = 'Detail Transaksi';
		$active_nav = 'transaksi';
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/transaksi/by_pelanggan', compact('pelanggan', 'transaksis'));
		$this->load->view('back/after');
		
    }
	
	public function detail($id_transaksi) {		
		if(!$id_transaksi) {
			redirect('admin/transaksi', 'refresh');
		}

		$transaksi = $this->Transaksi->get_transaksi($id_transaksi);
		if(empty($transaksi)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data transaksi'));
			redirect('admin/transaksi', 'refresh');	
		}
		
		$pelanggan = $this->Pelanggan->get_pelanggan_by_id($transaksi['id_pelanggan']);		
		$lama_sewa = $this->Transaksi->get_lama_sewa($id_transaksi);		
		$page_title = 'Detail Transaksi';
		$active_nav = 'transaksi';
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/transaksi/detail', compact('pelanggan', 'transaksi', 'lama_sewa'));
		$this->load->view('back/after');
		
	}
	
	public function kembalikan($id_transaksi) {	
		if(!$id_transaksi) {
			redirect('admin/transaksi', 'refresh');
		}
		$transaksi = $this->Transaksi->get_transaksi($id_transaksi);
		if(empty($transaksi)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data transaksi'));
			redirect('admin/transaksi', 'refresh');	
		}
		
		$this->Transaksi->kembalikan_sewa($id_transaksi);
		$this->session->set_flashdata('alert', alert_success('Persewaan sudah dikembalikan'));
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function add($id_pelanggan) {		
		
		if(!$id_pelanggan) {
			redirect('admin/transaksi', 'refresh');
		}		
		$id = $id_pelanggan;
		
		$pelanggan = $this->Pelanggan->get_pelanggan_by_id($id);
		
		if(empty($pelanggan)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data pelanggan'));
			redirect('admin/transaksi', 'refresh');	
		}
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {	
				
			
			$this->form_validation->set_rules($this->Transaksi->get_validation_config());		
			
			if($this->form_validation->run()) {
				
				$id_transaksi = $this->Transaksi->add_new($id);
				
				if($id_transaksi) {
					$this->session->set_flashdata('alert', alert_success('Peminjaman berhasil dibuat'));
					redirect('admin/transaksi/detail/'.$id_transaksi, 'refresh');					
				} else {
					$this->session->set_flashdata('alert', alert_error('Peminjaman gagal dibuat'));					
				}				
			}
		}
		
		$produks = $this->Produk->get_all();
		
		$page_title = 'Tambah Transaksi';
		$active_nav = 'transaksi';
		
		$this->load->view('back/before', compact('page_title', 'active_nav', 'active_sub_nav'));
		$this->load->view('back/transaksi/add', compact('pelanggan', 'produks'));
		$this->load->view('back/after');
		
	}
	
	public function add_item($id_transaksi) {
		if(!$id_transaksi) {
			redirect('admin/transaksi', 'refresh');
		}
		
		$transaksi = $this->Transaksi->get_transaksi($id_transaksi);
		if(empty($transaksi)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data transaksi'));
			redirect('admin/transaksi', 'refresh');	
		}
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {	
			
			$validation_cfg = $this->Transaksi->get_validation_config();
			unset($validation_cfg['lama_sewa']);
			$this->form_validation->set_rules($validation_cfg);
			
			if($this->form_validation->run()) {
				$is_success = $this->Transaksi->add_new_item($id_transaksi);
				if($is_success) {
					$this->session->set_flashdata('alert', alert_success('Item berhasil ditambah'));
					redirect('admin/transaksi/detail/'.$id_transaksi, 'refresh');					
				} else {
					$this->session->set_flashdata('alert', alert_error('Item gagal ditambah'));					
				}				
			}
			
		}
		
		$produks = $this->Produk->get_all();
		$page_title = 'Tambah Item';
		$active_nav = 'transaksi';
		
		$this->load->view('back/before', compact('page_title', 'active_nav'));
		$this->load->view('back/transaksi/add_item', compact('id_transaksi', 'produks'));
		$this->load->view('back/after');
	}
	
	public function edit_item($id, $id_transaksi) {		
		if(!$id) {
			redirect('admin/transaksi', 'refresh');
		}
		$item = $this->Transaksi->get_item($id);
		if(empty($item)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data transaksi'));
			redirect('admin/transaksi', 'refresh');	
		}
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {	
			
			$validation_cfg = $this->Transaksi->get_validation_config();
			unset($validation_cfg['lama_sewa']);
			$this->form_validation->set_rules($validation_cfg);
			
			if($this->form_validation->run()) {
				$is_success = $this->Transaksi->edit_item($id, $id_transaksi);
				if($is_success) {
					$this->session->set_flashdata('alert', alert_success('Item berhasil diedit'));
					redirect('admin/transaksi/detail/'.$id_transaksi, 'refresh');					
				} else {
					$this->session->set_flashdata('alert', alert_error('Item gagal diedit'));					
				}				
			}
			
		}
		
		$produks = $this->Produk->get_all();
		$page_title = 'Edit Item';
		$active_nav = 'transaksi';
		
		$this->load->view('back/before', compact('page_title', 'active_nav'));
		$this->load->view('back/transaksi/edit_item', compact('id_transaksi', 'item', 'produks'));
		$this->load->view('back/after');
		
	}
	
	public function del_item($id, $id_transaksi) {
		if(!$id) {
			redirect('admin/transaksi', 'refresh');
		}
		
		$item = $this->Transaksi->get_item($id);
		
		if(empty($item)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya item yang akan dihapus'));			
		} else {
			$result = $this->Transaksi->del_item($id, $id_transaksi);
			if($result) {
				$this->session->set_flashdata('alert', alert_success('Item telah sukses dihapus'));
			} else {
				$this->session->set_flashdata('alert', alert_success('Item ternyata gagal dihapus'));
			}			
		}
		
		redirect('admin/transaksi/detail/'.$id_transaksi, 'refresh');
		
	}
	
	public function del($id_transaksi, $id_pelanggan = NULL) {
		if(!$id_transaksi) {
			redirect('admin/transaksi', 'refresh');
		}
		
		$transaksi = $this->Transaksi->get_transaksi($id_transaksi);
		if(empty($transaksi)) {
			$this->session->set_flashdata('alert', alert_error('Tidak diketemukan adanya data transaksi'));
			redirect('admin/transaksi', 'refresh');	
		}
		$result = $this->Transaksi->del_transaksi($id_transaksi);
		
		if($result) {
			$this->session->set_flashdata('alert', alert_success('Transaksi telah sukses dihapus'));
		} else {
			$this->session->set_flashdata('alert', alert_success('Transaksi ternyata gagal dihapus'));
		}		
		
		if(!$id_pelanggan) {
			redirect('admin/transaksi', 'refresh');
		} else {
			redirect('admin/transaksi/pelanggan/'.$transaksi['id_pelanggan'], 'refresh');
		}
		
	}

}