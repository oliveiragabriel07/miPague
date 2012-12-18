<?php
class GroupDTO {
	public $id;

	public $name;

	public $cls;

	function __construct(GroupModel $group) {
		$this->id = $group->id;
		$this->name = $group->name;
		$this->cls = $group->class;
	}

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