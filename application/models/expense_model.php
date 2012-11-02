<?php

class Expense_model extends CI_Model {
	const TABLE_NAME = 'T_EXPENSE'; 
	
	private $id;
	private $activity_id;
	private $user_id;
	private $value;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $activity_id
	 */
	public function getActivityId() {
		return $this->activity_id;
	}

	/**
	 * @param field_type $activity_id
	 */
	public function setActivityId($activity_id) {
		$this->activity_id = $activity_id;
	}

	/**
	 * @return the $user_id
	 */
	public function getUserId() {
		return $this->user_id;
	}

	/**
	 * @param field_type $user_id
	 */
	public function setUserId($user_id) {
		$this->user_id = $user_id;
	}

	/**
	 * @return the $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param field_type $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	function add() {
		$this->db->insert(self::TABLE_NAME, get_object_vars($this));
		
		// sets the id as the last inserted id on the database
		$this->id = $this->db->insert_id();
	}
}
?>