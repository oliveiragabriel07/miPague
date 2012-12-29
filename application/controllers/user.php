<?php
require_once 'application/dtos/UserDTO.php';
require_once 'application/dtos/GroupDTO.php';

class User extends Lock_Controller {
	
	function index() {
		$user = new UserModel();
		$user->get($this->getSessionId());
		$user->groups = $user->fetchLink('groups');
		
		$data['user'] = UserDTO::newInstance($user);
		$this->load->view('home_view', $data);
	}
}

?>