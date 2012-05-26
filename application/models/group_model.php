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
			$group = new GroupDTO();
			$this->copyGroup($group, $row);
			$groupList[] = $group;
		}
		
		return $groupList;
	}

	function copyGroup($group, $o) {
		$group->setId($o->ID);
		$group->setName($o->NAME);
		$group->setCls($o->CLASS);
	}
}

?>