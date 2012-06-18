<?php 
Class UserDTO {
	public $id;
	
	public $name;
	
	public $surname;
	
	public $nickname;
	
	public $username;
	
	public $status;
	
	public $groupList;
	
	public $balanceList;
	
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
	
	function getSurName() {
		return $this->surname;
	}
	
	function setSurName($surname) {
		$this->surname = $surname;
	}
	
	function getNickName() {
		return $this->nickname;
	}
	
	function setNickName($nickname) {
		$this->nickname = $nickname;
	}

	function getUserName() {
		return $this->username;
	}
	
	function setUserName($username) {
		$this->username = $username;
	}	
	
	function getStatus() {
		return $this->status;
	}
	
	function setStatus($status) {
		$this->status = $status;
	}
	
	function getGroupList() {
		return $this->groupList;
	}
	
	function setGroupList($groupList) {
		$this->groupList = $groupList;
	}
	
	function getBalanceList() {
		return $this->balanceList;
	}
	
	function setBalanceList($balanceList) {
		$this->balanceList = $balanceList;
	}
}

?>