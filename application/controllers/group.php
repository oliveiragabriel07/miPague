<?php
 
class Group extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->model('User_model', 'user');
		$this->load->model('Activity_model', 'activity');
		if(!$this->user->isLogged()) {
			redirect('login');
		}
	}
	
	function getGroupActivity() {
		$groupId = $this->input->get('groupId');
		//check if user has group
		
		$activityList = $this->activity->getGroupActivity($groupId);
//		return json_encode($activityList);
		echo var_dump(json_encode($activityList));
	}
}

?>