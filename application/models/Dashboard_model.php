<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_model {
	
	public function get_profile_by_login($username, $password) {
		
		$where = array(
			'username' => $username,
			'password' => $password,
		);
		
		$result_set = $this->db->get_where('user', $where);
		
		return $result_set->row();
		
	}
	
}