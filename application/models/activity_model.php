<?php 

include 'application/dtos/ActivityDTO.php';
require_once 'application/models/abstract_model.php';

class Activity_model extends Abstract_model {
	
	const TABLE_NAME = 'T_ACTIVITY'; 
	
	private $group_id;
	private $activity_type; //TODO remove
	private $value;
	private $date;
	private $desc;
	
	function __construct() {
		parent::__construct($this);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Abstract_model::parseQueryResult()
	 */
	protected function parseQueryResult($result) {
		$this->group_id = $result->GROUP_ID;
		$this->activity_type = $result->ACTIVITY_TYPE;
		$this->value = $result->VALUE;
		$this->date = $result->DATE;
		$this->desc = $result->DESC;
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
	 * @return the $groupId
	 */
	public function getGroupId() {
		return $this->group_id;
	}

	/**
	 * @return the $activityType
	 */
	public function getActivityType() {
		return $this->activity_type;
	}

	/**
	 * @return the $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return the $date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @return the $desc
	 */
	public function getDesc() {
		return $this->desc;
	}

	/**
	 * @param field_type $group_id
	 */
	public function setGroupId($group_id) {
		$this->group_id = $group_id;
	}

	/**
	 * @param field_type $activityType
	 */
	public function setActivityType($activity_type) {
		$this->activity_type = $activity_type;
	}

	/**
	 * @param field_type $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * @param field_type $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @param field_type $desc
	 */
	public function setDesc($desc) {
		$this->desc = $desc;
	}

	function getGroupActivity($groupId) {
		$query = $this->db->query(
				"SELECT A.ID AS ACTIVITY_ID, A.DESC, A.VALUE, A.DATE, A.ACTIVITY_TYPE, UFROM.NAME AS FROM_NAME, UTO.NAME AS TO_NAME, '' AS USERLIST
				FROM T_ACTIVITY AS A
				INNER JOIN (
				T_USER AS UFROM
				INNER JOIN (
				T_REPAYMENT AS P
				INNER JOIN T_USER AS UTO ON UTO.ID = P.TO_ID
		) ON UFROM.ID = P.FROM_ID
		) ON A.ID = P.ACTIVITY_ID
				WHERE A.GROUP_ID = $groupId
				UNION
				SELECT A.ID AS ACTIVITY_ID, A.DESC, A.VALUE, A.DATE, A.ACTIVITY_TYPE, '' AS FROM_NAME, '' AS TO_NAME, GROUP_CONCAT( DISTINCT U.NAME ) AS USERLIST
				FROM T_ACTIVITY AS A
				INNER JOIN (
				T_EXPENSE AS X
				INNER JOIN T_USER AS U ON X.USER_ID = U.ID
		) ON A.ID = X.ACTIVITY_ID
				WHERE A.GROUP_ID = $groupId
				GROUP BY ACTIVITY_ID
				ORDER BY DATE DESC
				LIMIT 0 , 30"
		);
	
		$activityList = array();
		foreach ($query->result() as $row) {
			$activityList[] = $this->copyActivity($row);
		}
	
		return $activityList;
	}

	function copyActivity($activity) {
		$activityDTO = new ActivityDTO();
		$activityDTO->setId($activity->ACTIVITY_ID);
		$activityDTO->setDescription($activity->DESC);
		$activityDTO->setValue($activity->VALUE);
		$activityDTO->setDate($activity->DATE);
		$activityDTO->setType($activity->ACTIVITY_TYPE);
		$activityDTO->setUserFrom($activity->FROM_NAME);
		$activityDTO->setUserTo($activity->TO_NAME);
		$activityDTO->setUserList($activity->USERLIST);
		return $activityDTO;
	}
}

?>
