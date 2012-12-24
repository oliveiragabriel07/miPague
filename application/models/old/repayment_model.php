<?php 

require_once 'application/models/abstract_model.php';

class Repayment_model extends Abstract_model {
	
	const TABLE_NAME = 'T_REPAYMENT'; 
	
	private $activity_id;
	private $from_id;
	private $to_id;
	private $receipt; //TODO remove ?
	private $value;

	// TODO add status
	// TODO add pending_value
	
	/**
	 * (non-PHPdoc)
	 * @see Abstract_model::parseQueryResult()
	 */
	protected function parseQueryResult($result) {
		$this->id = $result->ID;
		$this->activity_id = $result->ACTIVITY_ID;
		$this->from_id = $result->FROM_ID;
		$this->to_id = $result->TO_ID;
		$this->value = $result->VALUE;
		$this->receipt = $result->RECEIPT;
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
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
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
	 * @return the $from_id
	 */
	public function getFromId() {
		return $this->from_id;
	}

	/**
	 * @return the $to_id
	 */
	public function getToId() {
		return $this->to_id;
	}

	/**
	 * @return the $receipt
	 */
	public function getReceipt() {
		return $this->receipt;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $from_id
	 */
	public function setFromId($from_id) {
		$this->from_id = $from_id;
	}

	/**
	 * @param field_type $to_id
	 */
	public function setToId($to_id) {
		$this->to_id = $to_id;
	}

	/**
	 * @param field_type $receipt
	 */
	public function setReceipt($receipt) {
		$this->receipt = $receipt;
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
