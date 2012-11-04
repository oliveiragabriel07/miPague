<?php 
class Transfer {
	private $userId;
	
	private $value;
	
	function getUserId() {
		return $this->userId;
	}
	
	function setUserId($userId) {
		$this->userId = $userId;
	}
	
	function getValue() {
		return $this->value;
	}
	
	function setValue($value) {
		$this->value = $value;
	}
	
	/**
	 * Compares two Transfers according to their $value
	 * @param Transfer $a
	 * @param Transfer $b
	 * @return return an integer less than, equal to, 
	 * or greater than zero if the first Transfer value is
	 * respectively less than, equal to, or greater than the second.
	 */
	static function compare(Transfer $a, Transfer $b) {
		return $a->value - $b->value;
	}
	
	/**
	 * Reverse(BIGGER first) compares two Transfers according to their $value.
	 * 
	 * Same as compare($b, $a).
	 * 
	 * @param Transfer $a
	 * @param Transfer $b
	 * @return return an integer less than, equal to,
	 * or greater than zero if the first Transfer value is
	 * respectively greater than, equal to, or less than the second.
	 */
	static function revCompare(Transfer $a, Transfer $b) {
		return static::compare($b, $a);
	}
}

?>