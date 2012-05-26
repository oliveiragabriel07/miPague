<?php 

Class ActivityDTO {
	public $id;
	
	public $type;
	
	public $value;
	
	public $date;
	
	public $description;
	
	public $userList;
	
	public $userFrom;
	
	public $userTo;
	
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
	
	function getDescription() {
		return $this->description;
	}
	
	function setDescription($description) {
		$this->description = $description;
	}

	function getUserList() {
		return $this->userList;
	}
	
	function setUserList($userList) {
		$this->userList = $userList;
	}
	
	function getUserFrom() {
		return $this->userFrom;
	}
	
	function setUserFrom($userFrom) {
		$this->userFrom= $userFrom;
	}
	
	function getUserTo() {
		return $this->userTo;
	}
	
	function setUserTo($userTo) {
		$this->userTo= $userTo;
	}	
}

?>