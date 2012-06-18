<?php
include 'application/dtos/UserDTO.php';

Class User_model extends CI_Model {
	function get($id) {
		$this->db->where('ID', $id);
		$this->db->from('T_USER');
		$query = $this->db->get();
		$o = $query->first_row();

		$user = new UserDTO();
		$user->setId($o->ID);
		$user->setName($o->NAME);
		$user->setSurName($o->SURNAME);
		$user->setNickName($o->NICKNAME);
		$user->setUserName($o->USERNAME);
		$user->setStatus($o->STATUS);
		return $user;
	}
	
	function getActiveUserId() {
		if ($this->session->userdata('user_id')) {
			return $this->session->userdata('user_id');
		}
		
		return null;
	}
	
	function getActiveUserData () {
		$id = $this->getActiveUserId();
		return $this->get($id);
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