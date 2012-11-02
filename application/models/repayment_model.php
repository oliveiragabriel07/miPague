<?php 

class Repayment_model extends CI_Model {
	
	const TABLE_NAME = 'T_REPAYMENT'; 
	
	// TODO add id;
	
	private $activity_id;
	private $from_id;
	private $to_id;
	private $receipt;
	
	// TODO add status
	// TODO add value
	// TODO add pending_value
	
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
	 * Adds the repayment instance to the db.
	 * Sets the $id from the db after insertion 
	 */
	public function add() {
		$this->db->insert(self::TABLE_NAME, get_object_vars($this));
		
		// sets the id as the last inserted id on the database
		$this->id = $this->db->insert_id();
	}
}

?>
