<?php
include 'application/dtos/UserDTO.php';

Class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->model('Group_model', 'group');
	}
	
	function getById($id) {
		$this->db->where('ID', $id);
		$this->db->from('T_USER');
		$query = $this->db->get();
		$user = $this->copyUserDetails($query->first_row());
		$user->setGroupList($this->group->getUserGroupList($id));
		
		return $user;
	}
	
	function getId() {
		if ($this->session->userdata('user_id')) {
			return $this->session->userdata('user_id');
		}
		
		return null;
	}
	
	function getUserDetails () {
		return $this->getById($this->getId());
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
	
	function copyUserDetails($user) {
		$userDTO = new UserDTO();
		$userDTO->setId($user->ID);
		$userDTO->setName($user->NAME);
		$userDTO->setSurName($user->SURNAME);
		$userDTO->setNickName($user->NICKNAME);
		$userDTO->setUserName($user->USERNAME);
		$userDTO->setStatus($user->STATUS);
		return $userDTO;
	}
}
?>