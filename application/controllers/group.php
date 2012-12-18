<?php
require_once 'application/dtos/GroupDTO.php';
class Group extends Lock_Controller {
	
	function getList() {
		$group = new GroupModel();
		$user = new UserModel();
		$user->id = $this->getSessionId();
		$group->join($user);
		$group->selectAs();
		$group->find();
		
		$groupList = array();
		while($group->fetch()) {
			$groupList[] = new GroupDTO($group);
		}
		
		echo json_encode($groupList);
	}
	
	function getGroupActivity() {
		$groupId = $this->input->get('groupId');
		//check if user has group
		
		$activityList = $this->activity->getGroupActivity($groupId);
		echo json_encode($activityList);
	}
}

?>