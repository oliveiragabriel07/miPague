<?php

require_once 'application/models/abstract_model.php';

class Expense_model extends Abstract_model {
	const TABLE_NAME = 'T_EXPENSE'; 
	
	private $activity_id;
	private $user_id;
	private $value;
	
	function __construct() {
		parent::__construct();
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
	
	/**
	 * (non-PHPdoc)
	 * @see Abstract_model::parseQueryResult()
	 */
	protected function parseQueryResult($result) {
		$this->activity_id = $result->ACTIVITY_ID;
		$this->user_id = $result->USER_ID;
		$this->value = $result->VALUE;
		return $this;
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
}
?>