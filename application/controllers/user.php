<?php
require_once 'application/dtos/UserDTO.php';

class User extends Lock_Controller {
	
	function index() {
		$user = new UserModel();
		$user->get($this->getSessionId());
		
		$data['user'] = new UserDTO($user);
		$this->load->view('home_view', $data);
	}

}

?>