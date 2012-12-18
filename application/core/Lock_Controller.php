<?php 
class Lock_Controller extends MP_Controller {
	function __construct() {
		parent::__construct();
	
		if (!$this->isLogged()) {
			redirect('login');
		}
	}
}
?>