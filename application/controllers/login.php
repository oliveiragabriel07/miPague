<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Login extends MP_Controller {
	
	function index() {
		//verifica se usuario esta logado
		if ($this->isLogged()) {
			redirect('user');
		} else {
			$this->load->view('login_view');			
		}
	}
	
	function doLogin() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if ($this->validateCredentials($username, $password)) {
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
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		redirect('login');
	}
	
	private function validateCredentials($username, $password) {
		$user = new UserModel();
		$user->username = $username;
		$user->password = MD5($password);
		$user->find(true);
		
		if($user->numrows() == 1) {
			$this->session->set_userdata('user_id', $user->id);
			return true;
		}
		
		return false;
	}
}

?>