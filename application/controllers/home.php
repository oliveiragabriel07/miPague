<?php

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('User_model', 'user');
		if(!$this->user->isLogged()) {
			redirect('');
		}
	}
	
	function index() {
		$this->load->view('home_view.html');
	}
}

?>