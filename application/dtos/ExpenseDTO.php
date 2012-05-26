<?php 

Class ActivityDTO {
	public $id;
	
	public $type;
	
	public $value;
	
	public $date;
	
	public $child;
	
	function getId() {
		return $this->id;
	}
	
	function setId($id) {
		$this->id = $id;
	}
	
	function getType() {
		return $this->type;
	}
	
	function setType($type) {
		$this->type = $type;
	}
	
	function getValue() {
		return $this->value;
	}
	
	function setValue($value) {
		$this->value= $value;
	}
	
	function getDate() {
		return $this->date;
	}
	
	function setDate($date) {
		$this->date = $date;
	}
	
	function getChild() {
		return $this->child;
	}
	
	function setChild($child) {
		$this->child = $child;
	}
}

?>