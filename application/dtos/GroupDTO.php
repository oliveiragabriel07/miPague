<?php 
Class GroupDTO {
	public $id;
	
	public $name;
	
	public $cls;
	
	function getId() {
		return $this->id;
	}
	
	function setId($id) {
		$this->id = $id;
	}
	
	function getName() {
		return $this->name;
	}
	
	function setName($name) {
		$this->name = $name;
	}
	
	function getCls() {
		return $this->cls;
	}
	
	function setCls($cls) {
		$this->cls = $cls;
	}
}

?>