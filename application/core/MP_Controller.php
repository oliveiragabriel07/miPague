<?php
class MP_Controller extends CI_Controller {
	protected function isLogged() {
		if ($this->session->userdata('user_id')) {
			return true;
		}
		
		return false;
	}
	
	protected function getSessionId() {
		if ($this->session->userdata('user_id')) {
			return $this->session->userdata('user_id');
		}
		
		return null;
	}	
}

require_once 'Lock_Controller.php';

?>