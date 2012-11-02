<?php 

abstract class Abstract_model extends CI_Model {
	
	protected $id;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @return int the $id
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * Returns the database table name used to store this model
	 */
	protected abstract function getTableName();
	
	/**
	 * Returns the object as an array to be stored on the db
	 */
	protected abstract function getObjectAsArray();
	
	/**
	 * Parses the query result for the get() method, 
	 * setting the fields of the current object
	 * 
	 * @param $result the query result to be parsed
	 * @return the object instance
	 */
	protected abstract function parseQueryResult($result);
	
	/**
	 * Adds the instance to the db.
	 * Sets the $id from the db after insertion 
	 */
	public function add() {
		$this->db->insert($this->getTableName(), $this->getObjectAsArray());
		
		// sets the id as the last inserted id on the database
		$this->id = $this->db->insert_id();
	}
	
	/**
	 * Gets the object from the db with the specified $id
	 * @param int $id
	 * @return the query result
	 */
	public function get($id) {
		$query = $this->db->select()->from($this->getTableName())->where('id', $id)->get();
		if ($query->num_rows() == 1) {
			$result = $query->row();
			$this->id = $result->ID;
			return $this->parseQueryResult($result);
			
		} else {

			echo('GET query returned more than one result. ');
			echo('query = TABLE(' . $this->getTableName() . ') & id(' . $id . '); ');
			return NULL;
		}
		
	}
}

?>
