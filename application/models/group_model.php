<?php 

include 'application/dtos/GroupDTO.php';

Class Group_Model extends CI_Model {
	function getUserGroupList($id) {
		$this->db->from('T_GROUP AS G');
		$this->db->join('T_USER_GROUP AS U', 'U.GROUP_ID = G.ID');
		$this->db->where('USER_ID', $id);		
		
		$groupList = array();
		$query = $this->db->get();
		
		foreach ($query->result() as $row) {
			$group = $this->copyGroup($row);
			$groupList[] = $group;
		}
		
		return $groupList;
	}

	function copyGroup($group) {
		$groupDTO = new GroupDTO();
		$groupDTO->setId($group->ID);
		$groupDTO->setName($group->NAME);
		$groupDTO->setCls($group->CLASS);
		return $groupDTO;
	}
}

?>