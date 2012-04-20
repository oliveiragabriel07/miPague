<?php 
Class User_model extends CI_Model {
	function get($id) {
		$this->db->where('ID', $id);
		
		$result = $this->db->get('T_USER');
		return $result->first_row();
	}
	
	function validate($username, $password) {
		$this->db->where('USERNAME', $username);
		$this->db->where('PASSWORD', MD5($password));
		
		$query = $this->db->get('T_USER');
		
		if ($query->num_rows() == 1) {
			$row = $query->first_row();
			$this->startSession($row);
			
			return true;
		}
		
		return false;
	}
	
	function isLogged() {
		if ($this->session->userdata('user_id')) {
			return true;
		}
		
		return false;
	}
	
	function startSession($row) {
		$this->session->set_userdata('user_id', $row->ID);
	}

	function endSession() {
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
	}
}
?>