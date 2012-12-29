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

		try {
			$this->validateCredentials($username, $password);
			echo json_encode(array('success' => true, 'url' => 'user'));
		} catch (Exception $e) {
			echo json_encode(array('success' => false, 'message' => $e->getMessage()));
		}
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

		if ($user->numrows() != 1) {
			throw new Exception('Usuario ou senha incorretos');
		}

		$this->session->set_userdata('user_id', $user->id);
	}
}

?>