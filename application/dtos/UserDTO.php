<?php
require_once 'GroupDTO.php';

class UserDTO {
	public $id;

	public $name;

	public $surname;

	public $displayname;

	public $username;

	public $status;

	public $groupList;

	public $balanceList;
	
	public static function newInstance(UserModel $user) {
		$dto = new UserDTO();
		$dto->id = $user->id;
		$dto->name = $user->name;
		$dto->surname = $user->surname;
		$dto->displayname = $user->displayname;
		$dto->username = $user->username;
		$dto->status = $user->status;
		$dto->groupList = array();
		
		foreach ($user->groups as $group) {
			$dto->groupList[] = new GroupDTO($group);
		}
		
		return $dto;
	}
}

?>