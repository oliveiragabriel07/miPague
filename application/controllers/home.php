<?php

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->model('Group_model', 'group');
		$this->load->model('User_model', 'user');
		if(!$this->user->isLogged()) {
			redirect('login');
		}
	}
	
	function index() {
		$this->load->view('home_view.html');
	}
	
	function getUserGroupList() {
		$userId = $this->user->getActiveUserId();
		$result = $this->group->getUserGroupList($userId);
		
		echo json_encode($result->result());
	}
}

?>