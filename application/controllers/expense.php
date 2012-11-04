<?php

require_once 'application/dtos/Transfer.php';

class Expense extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Activity_model');
		$this->load->model('Expense_model');
		$this->load->model('Repayment_model');
		$this->load->model('User_model');
	}
	
	function index() {
		$this->output->enable_profiler(TRUE);
		
		$data = $this->input->post();
		
		// TODO validate all data
		// activity:
			// group id is number and exists
			// type ? remove
			// value is a valid value
			// user logged belongs to the group id
			// description is valid
			
		// who paid? - expenses
			// user id is number, exists, belongs to the group
			// value is a valid value
			// SUM of all values == activity.value
			// all may be null? 
				// if so then logged user paid all
			
		// how much need to pay?
			// user id is number, exists, belongs to the group
			// value is a valid value
			// SUM of all values == activity.value
			// all may be null?
				// if so then needs to fill default values (each user from group, value = total/group.size)
		
		// adds the activity
		$activity = $this->createActivity($data);
		
		// .. then add the expenses
		$expenseList = array();
		for($i = 0 ; $i < sizeof($data['pay_user_id']) ; $i++) {
			$expense = $this->createExpense($activity, $data['pay_user_id'][$i], $data['pay_user_value'][$i]);
			array_push($expenseList, $expense);
		}
		
		// .. and then the repayments
		$groupUsers = $this->User_model->getAllByGroupId($activity->getGroupId());
		
		// pay value for each user (sets 0 as default)
		$payValues = $this->createPayValues($data, $groupUsers);
		
		$payList = array(); // Transfer list of user that need to PAY
		$recList = array(); // Transfer list of user that need to RECEIVE

		$this->fillPayAndReceiveLists($payList, $recList, $groupUsers, $payValues, $expenseList);
		
		$this->generateRepayments($payList, $recList, $activity);
		
	}
	
	/**
	 * Generates and saves all repayments needed based on payList and recList
	 * @param unknown_type $payList list of transfers to be paid
	 * @param unknown_type $recList list of transfers to be received
	 * @param unknown_type $activity the activity
	 */
	private function generateRepayments($payList, $recList, $activity) {
		foreach ($payList as $payTransfer) {
			foreach ($recList as $recTransfer) {
		
				$payValue = $payTransfer->getValue();
				if($payValue == 0) {
					// noting more to pay, goes to next payment transfer
					break;
				}
		
				$recValue = $recTransfer->getValue();
				if($recValue == 0) {
					// noting more to receive, goes to next receive transfer
					continue;
				}
		
				// calculate a repayment value
				$repayValue = $payValue < $recValue ? $payValue : $recValue;
		
				// creates and saves the repayment
				$this->createRepayment($activity->getId(), $payTransfer->getUserId(),
						$recTransfer->getUserId(), $repayValue);
			}
			//re-orders receive list (DESCENDING)
			usort($recList, array("Transfer", "revCompare"));
		}
	}
	
	/**
	 * Fills the transfers list for those that need to pay and receive, ordering both DESCENDING by value
	 * @param unknown_type $payList list to be filled of transfers to be paid
	 * @param unknown_type $recList list to be filled of transfers to be received
	 * @param unknown_type $groupUsers the group users
	 * @param unknown_type $payValues the array of values to be paid by each user. Indexed by userId
	 * @param unknown_type $expenseList the list of expenses already created.
	 */
	private function fillPayAndReceiveLists(&$payList, &$recList, $groupUsers, $payValues, $expenseList) {
		foreach ($groupUsers as $user) {
			// gets how much the user already paid
			$userPaid = $this->getUserPaidValue($user, $expenseList);
				
			// how much the user need to pay
			$userDebt = $payValues[$user->getId()];
		
			// calculates the balance
			$userBalance = $userPaid - $userDebt;
				
			// creates the transfer for this user
			$transfer = $this->createTransfer($user, $userBalance);
		
			// Adds the transfer to the correct array if the balance is positeve or negative
			if($userBalance > 0) {
				// needs to RECEIVE value
				array_push($recList, $transfer);
			} elseif ($userBalance < 0) {
				// needs to PAY value
				array_push($payList, $transfer);
			}
		}
		
		//orders both lists DESCENDING
		usort($recList, array("Transfer", "revCompare"));
		usort($payList, array("Transfer", "revCompare"));
	}
	
	/**
	 * Creates a payValues array with how much of this activity each user from the group needs to pay.
	 * Those user who do not have to pay get 0 as value.
	 * @param unknown_type $data post data
	 * @param unknown_type $groupUsers all users from this group
	 * @return array the payValues array indexed by userId as key and valueToPay as value
	 */
	private function createPayValues($data, $groupUsers) {
		$payValues = array();
		foreach ($groupUsers as $user) {
			$payValues[$user->getId()] = 0.0;
		}
		// sets the correct value based on view
		for($i = 0 ; $i < sizeof($data['rec_user_id']) ; $i++) {
			// adds to the array as repaymentValues[userId] = value.. e.g repaymentValues[3] = 23.45
			$payValues[$data['rec_user_id'][$i]] = $data['rec_user_value'][$i];
				
		}
		return $payValues;
	}
	
	/**
	 * Creates a new Tranfer with the userId and value do pay/receive
	 * 
	 * @param User_model $user the user
	 * @param double $userBalance how much the user needs to pay or receive
	 * 
	 * @return Transfer the created transfer object 
	 */
	 private function createTransfer($user, $userBalance) {
		$transfer = new Transfer();
		$transfer->setUserId($user->getId());
		$transfer->setValue(abs($userBalance));
		return $transfer;
	}

	
	/**
	 * Gets how much the user paid given the expense list.
	 * @param User_model $user the user
	 * @param array $expenseList the expense list to be analysed (user is in at most 1 expense)
	 * @return double how much the user paid on the given expense list
	 */
	private function getUserPaidValue(User_model $user, array $expenseList) {
		$paid = 0;
		foreach ($expenseList as $expense) {
			if($user->getId() == $expense->getUserId()) {
				// already paid $expense value
				$paid = $expense->getValue();
				
				break; // at most one expense per user
			}
		}
		return $paid;
	}
	
	/**
	 * Creates the repayment and saves on db
	 * @param int $activity activity id that this repayment belongs to
	 * @param int $fromId the user id of the user paying the repayment
	 * @param int $toId the user id of the user receiving the repayment
	 * @param int $value the value of the payment
	 * @return the repayment created and saved
	 */
	private function createRepayment($activityId, $fromId, $toId, $value) {
		$repayment = new Repayment_model();
		$repayment->setActivityId($activityId);
		$repayment->setFromId($fromId);
		$repayment->setToId($toId);
		$repayment->setValue($value);
		return $repayment->add();
	}
	
	/**
	 * Creates the expense and saves on db
	 * @param Activity_model $activity
	 * @param int $userId
	 * @param int $value
	 * @return the expense
	 */
	 private function createExpense(Activity_model $activity, $userId, $value) {
		$expense = new Expense_model();
		$expense->setActivityId($activity->getId());
		$expense->setUserId($userId);
		$expense->setValue($value);
		return $expense->add();
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
		return $activity->add();
	}

	
}

?>