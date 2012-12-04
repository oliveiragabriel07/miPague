<?php
require_once 'lumine/Lumine.php';

class Lumine_ApplicationContext extends Lumine_EventListener {

	public function __construct() {
		include 'lumine-conf.php';
		$cfg = new Lumine_Configuration($lumineConfig);

		register_shutdown_function(array($cfg->getConnection(), 'close'));
		spl_autoload_register(array('Lumine', 'import'));
		spl_autoload_register(array('Lumine', 'loadModel'));

	}

}
