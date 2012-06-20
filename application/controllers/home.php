<?php

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->model('User_model', 'user');
		if(!$this->user->isLogged()) {
			redirect('login');
		}
	}
	
	function index() {
		$user = $this->user->getUserDetails();
		$data['user'] = $user;
		
		$this->load->view('home_view', $data);
	}
}

?>