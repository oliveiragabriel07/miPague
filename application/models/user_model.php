<?php
include 'application/dtos/UserDTO.php';
require_once 'application/models/abstract_model.php';

Class User_model extends Abstract_model {
	
	const TABLE_NAME = 'T_USER';
	
	private $name;
	private $surname;
	private $displayname;
	private $status;
	private $username;
	private $password;
	private $photo;
	
	function __construct() {
		parent::__construct();
		$this->load->model('Group_model', 'group');
	}
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return the $surname
	 */
	public function getSurname() {
		return $this->surname;
	}

	/**
	 * @param field_type $surname
	 */
	public function setSurname($surname) {
		$this->surname = $surname;
	}

	/**
	 * @return the $displayname
	 */
	public function getDisplayname() {
		return $this->displayname;
	}

	/**
	 * @param field_type $displayname
	 */
	public function setDisplayname($displayname) {
		$this->displayname = $displayname;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param field_type $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @return the $username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param field_type $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param field_type $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @return the $photo
	 */
	public function getPhoto() {
		return $this->photo;
	}

	/**
	 * @param field_type $photo
	 */
	public function setPhoto($photo) {
		$this->photo = $photo;
	}

	/**
	 * (non-PHPdoc)
	 * @see Abstract_model::parseQueryResult()
	 */
	protected function parseQueryResult($result) {
		$this->setId($result->ID);
		$this->setName($result->NAME);
		$this->setSurname($result->SURNAME);
		$this->setDisplayname($result->DISPLAYNAME);
		$this->setUserName($result->USERNAME);
		$this->setPassword($result->PASSWORD);
		$this->setStatus($result->STATUS);
		$this->setPhoto($result->PHOTO);
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Abstract_model::getTableName()
	 */
	protected function getTableName() {
		return self::TABLE_NAME;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Abstract_model::getObjectAsArray()
	 */
	protected function getObjectAsArray() {
		return get_object_vars($this);
	}
	
	function getById($id) {
		$this->db->where('ID', $id);
		$this->db->from('T_USER');
		$query = $this->db->get();
		$user = $this->copyUserDetails($query->first_row());
		$user->setGroupList($this->group->getUserGroupList($id));
		
		return $user;
	}
	
	/**
	 * Gets all users that belong to the specified group ($groupId)
	 * @param int $groupId the group id
	 * @return array of User_model of the users that belong to the group
	 */
	function getAllByGroupId($groupId) {
		// All users with GROUP_ID = $groupId
		$this->db->select();
		$this->db->from($this->getTableName());
		$this->db->join('T_USER_GROUP', 'T_USER_GROUP.USER_ID = T_USER.ID');
		$this->db->where('GROUP_ID', $groupId);
		$query = $this->db->get();
		
		// Adds a nre User_model for each row in the response array
		$response = array();
		if ($query->num_rows() > 0)	{
		   foreach ($query->result() as $row) {
		      $user = new User_model();
		      $user->parseQueryResult($row);
		      array_push($response, $user);
		   }
		}
		return $response;
	}
	
	function getSessionId() {
		if ($this->session->userdata('user_id')) {
			return $this->session->userdata('user_id');
		}
		
		return null;
	}
	
	function getUserDetails () {
		return $this->getById($this->getSessionId());
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
		$userDTO->setDisplayName($user->DISPLAYNAME);
		$userDTO->setUserName($user->USERNAME);
		$userDTO->setStatus($user->STATUS);
		return $userDTO;
	}
}
?>