<?php 

include 'application/dtos/GroupDTO.php';

Class Group_Model extends CI_Model {
	function getUserGroupList($id) {
		$this->db->select('*');
		$this->db->from('T_GROUP');
		$this->db->join('T_USER_GROUP', 'T_USER_GROUP.GROUP_ID = T_GROUP.ID');
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