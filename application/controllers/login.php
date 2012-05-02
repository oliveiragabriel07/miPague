<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->model('User_model', 'user');
	}
	
	function index() {
		//verifica se usuario esta logado
		if ($this->user->isLogged()) {
			redirect('');
		} else {
			$this->load->view('login_view.html');			
		}
	}
	
	function doLogin() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if ($this->user->validate($username, $password)) {
			$data = array(
				'success' => true,
				'url' => ''
			);
		} else {
			//TODO colocar mensagens em um helper
			$data = array(
				'success' => false,
				'message' => 'Usuario ou senha incorretos.'
			);
		}
		
		echo json_encode($data);
	}
	
	function logout() {
		$this->user->endSession();
		redirect('login');
	}
}

?>