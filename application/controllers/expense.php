<?php

class Expense extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Activity_model');
		$this->load->model('Expense_model');
		$this->load->model('Repayment_model');
	}
	
	function index() {
		$this->output->enable_profiler(TRUE);
		
		$data = $this->input->post();
		
		// TODO validate data
		
		// adds the activity
		$activity = $this->createActivity($data);
		
		
		// .. then add the expenses
		for($i = 0 ; $i < sizeof($data['user_id']) ; $i++) {
			$this->createExpense($activity, $data['user_id'][$i], $data['user_value'][$i]);
		}
		
		// .. and then the repayments
		
	}
	/**
	 * Creates the expense and saves on db
	 * @param Activity_model $activity
	 * @param int $userId
	 * @param int $value
	 */
	 private function createExpense(Activity_model $activity, $userId, $value) {
		$expense = new Expense_model();
		$expense->setActivityId($activity->getId());
		$expense->setUserId($userId);
		$expense->setValue($value);
		$expense->add();
	}

	/**
	 * Creates the activity and saves on the database
	 * @param $activityData
	 * @return Activity_model the created model
	 */
	private function createActivity($activityData) {
		$activity = new Activity_Model();
		$activity->setActivityType($activityData['type']);
		$activity->setDesc($activityData['desc']);
		$activity->setGroupId($activityData['group']);
		$activity->setValue($activityData['value']);
		$activity->add();
		return $activity;
	}

	
}

?>