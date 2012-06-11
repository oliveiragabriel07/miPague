<?php 

include 'application/dtos/ActivityDTO.php';

Class Activity_Model extends CI_Model {
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
		$activity->setUserList($o->USERLIST);
	}
}

?>
