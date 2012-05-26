<?php 

include 'application/dtos/ActivityDTO.php';

Class Activity_Model extends CI_Model {
	function getGroupActivity($groupId) {
		//get Expenses
//		$this->db->select('title, content, date');
//		$this->db->from('mytable');
//		
//		$expenses = $this->db->get_compiled_select();
//		$this->db->_reset_select();
		
		//get repayemnts
		$this->db->select('A.ID AS ACTIVITY_ID, A.DESC, A.VALUE, A.DATE, A.ACTIVITY_TYPE, UFROM.NAME AS FROM_NAME, UTO.NAME AS TO_NAME');
		$this->db->from('T_ACTIVITY AS A');
		$this->db->join('T_REPAYMENT AS P', 'A.ID = P.ACTIVITY_ID');
		$this->db->join('T_USER AS UFROM', 'P.FROM_ID = UFROM.ID');
		$this->db->join('T_USER AS UTO', 'P.TO_ID = UTO.ID');
		$this->db->where('A.GROUP_ID', $groupId);

		$repayments = $this->db->_compile_select();
		$this->db->_reset_select();
//		
//		//union
		$query = $this->db->query($repayments);

		$activityList = array();
		
		foreach ($query->result() as $row) {
			$activity = new ActivityDTO();
			$this->copyActivity($activity, $row);
			$activityList[] = $activity;
		}
		
		return $activityList;
	}

	function copyActivity($activity, $o) {
		$activity->setId($o->ACTIVITY_ID);
		$activity->setDescription($o->DESC);
		$activity->setValue($o->VALUE);
		$activity->setDate($o->DATE);
		$activity->setType($o->ACTIVITY_TYPE);
		$activity->setUserFrom($o->FROM_NAME);
		$activity->setUserTo($o->TO_NAME);
	}
}

?>