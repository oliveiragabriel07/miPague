<?php
 
class Group extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->model('User_model', 'user');
		$this->load->model('Group_model', 'group');
		$this->load->model('Activity_model', 'activity');
		if(!$this->user->isLogged()) {
			redirect('login');
		}
	}
	
	function getUserGroupList() {
		$userId = $this->user->getActiveUserId();
		$groupList = $this->group->getUserGroupList($userId);
		
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