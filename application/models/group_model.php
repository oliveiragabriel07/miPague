<?php 

Class Group_Model extends CI_Model {
	function getUserGroupList($id) {
		$this->db->select('*');
		$this->db->from('T_GROUP');
		$this->db->join('T_USER_GROUP', 'T_USER_GROUP.GROUP_ID = T_GROUP.ID');
		$this->db->where('USER_ID', $id);		
		
		$result = $this->db->get();
		
		if ($result->num_rows() > 0) {
			return $result;
		}
	}	
}

?>