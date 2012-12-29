<?php

require_once 'application/dtos/Transfer.php';
require_once 'application/enums/DebitStatusEnum.php';

class Expense extends Lock_Controller {
	
	function index() {
		$data = $this->input->post();
		
		// TODO validate all data
		// bill:
			// group id is number and exists
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
		
		// adds the bill
		$bill = $this->createBill($data);

		// .. then add the expenses
		$expenseList = array();
		foreach ($data['expenses'] as $expense) {
			$expenseList[] = $this->createExpense($bill, $expense['user'], $expense['value']);
		}
		
		// .. then add the debits
		$groupUsers = GroupModel::getAllUsers($bill->group);
		$shares = $data['shares'];
		
		// pay value for each user (sets 0 as default)
		$payList = array(); // Transfer list of user that need to PAY
		$recList = array(); // Transfer list of user that need to RECEIVE

		$this->fillPayAndReceiveLists($payList, $recList, $groupUsers, $shares, $expenseList);
		$debits = $this->generateDebits($payList, $recList, $bill);
		
		// finally, updates balances
		$this->calculateBalances($bill->group, $debits);
		
	}
	
	/**
	 * Generates and saves all debits needed based on payList and recList
	 * @param array $payList list of transfers to be paid
	 * @param array $recList list of transfers to be received
	 * @param BillModel $bill the bill
	 * @return array<DebitModel> $debits
	 */
	private function generateDebits(array $payList, array $recList, BillModel $bill) {
		$debits = array();
		foreach ($payList as $payTransfer) {
			foreach ($recList as $recTransfer) {
		
				$payValue = $payTransfer->getValue();
				
				if($payValue == 0) {
					// nothing more to pay, goes to next payment transfer
					break;
				}
		
				$recValue = $recTransfer->getValue();
				if($recValue == 0) {
					// noting more to receive, goes to next receive transfer
					continue;
				}
		
				// calculate a repayment value
				$repayValue = min(array($payValue, $recValue));
		
				// creates and saves the repayment
				$debits[] = $this->createDebit($bill->id, $payTransfer->getUserId(),
						$recTransfer->getUserId(), $repayValue);
			}
			
			//re-orders receive list (DESCENDING)
			usort($recList, array("Transfer", "revCompare"));
		}
		
		return $debits;
	}
	
	/**
	 * Fills the transfers list for those that need to pay and receive, ordering both DESCENDING by value
	 * @param unknown_type $payList list to be filled of transfers to be paid
	 * @param unknown_type $recList list to be filled of transfers to be received
	 * @param unknown_type $groupUsers the group users
	 * @param unknown_type $payValues the array of values to be paid by each user. Indexed by userId
	 * @param unknown_type $expenseList the list of expenses already created.
	 */
	private function fillPayAndReceiveLists(&$payList, &$recList, $groupUsers, $shares, $expenseList) {
		foreach ($groupUsers as $user) {
			// gets how much the user already paid
			$userPaid = $this->getUserPaidValue($user, $expenseList);
			
			// how much the user need to pay
			$userDebt = $this->getUserShare($user, $shares);
			
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
	 * Creates a new Tranfer with the userId and value do pay/receive
	 * 
	 * @param UserModel $user the user
	 * @param double $userBalance how much the user needs to pay or receive
	 * 
	 * @return Transfer the created transfer object 
	 */
	 private function createTransfer(UserModel $user, $userBalance) {
		$transfer = new Transfer();
		$transfer->setUserId($user->id);
		$transfer->setValue(abs($userBalance));
		return $transfer;
	}

	
	/**
	 * Gets how much the user paid given the expense list.
	 * @param UserModel $user the user
	 * @param array $expenseList the expense list to be analysed (user is in at most 1 expense)
	 * @return double how much the user paid on the given expense list
	 */
	private function getUserPaidValue(UserModel $user, array $expenseList) {
		$paid = $this->findObjByProperty($expenseList, 'user', $user->id);
		if ($paid == null) {
			return 0;
		}
		
		return $paid->value;
	}

	/**
	 * @param UserModel $user the user
	 * @param array $shares the shares list to be analysed (user is in at most 1 share)
	 * @return double the user share value
	 */
	private function getUserShare(UserModel $user, array $shares) {
		$share = $this->findArrayByProperty($shares, 'user', $user->id);
		
		if ($share == null) {
			return 0;
		}
		
		return $share['value'];
	}
	
	private function calculateBalances($groupId, array $debits) {
		foreach($debits as $debit) {
			$this->updateBalance($debit->from, $debit->to, $groupId, $debit->value);
			$this->updateBalance($debit->to, $debit->from, $groupId, (-1) * $debit->value);
		}
	}
	
	private function updateBalance($from, $to, $group, $debitValue) {
		$balance = new BalanceModel();
		$balance->from = $from;
		$balance->to = $to;
		$balance->group = $group;
		$balance->date = date('Y-m-d');
		$balance->find();
			
		if ($balance->numrows() > 0) {
			$balance->fetch();
		} else {
			$balance->value = 0;
		}
			
		$balance->value = $balance->value - $debitValue;
		$balance->save();
	}
	
	private function findObjByProperty(array $array, $prop, $value) {
		$resp = null;
		foreach($array as $item) {
			if ($item->{$prop} == $value) {
				$resp = $item;
				break;
			}
		}
		
		return $resp;
	}
	
	private function findArrayByProperty(array $array, $prop, $value) {
		$resp = null;
		foreach($array as $item) {
			if ($item[$prop] == $value) {
				$resp = $item;
				break;
			}
		}
	
		return $resp;
	}
	
	private function createDebit($billId, $fromId, $toId, $value) {
		$debit = new DebitModel();
		$debit->bill = $billId;
		$debit->from = $fromId;
		$debit->to = $toId;
		$debit->value = $value;
		$debit->status = DebitStatusEnum::UNPAID;
		$debit->pending = 0;
		return $debit->save(); 
	}
	
	/**
	 * Creates the expense and saves on db
	 * @param BillModel $bill
	 * @param int $user
	 * @param int $value
	 * @return ExpenseModel the created expense
	 */
	 private function createExpense(BillModel $bill, $user, $value) {
		$expense = new ExpenseModel();
		$expense->bill = $bill->id;
		$expense->user = $user;
		$expense->value = $value;
		return $expense->save();
	}

	/**
	 * Creates the bill and saves on the database
	 * @param $data
	 * @return BillModel the created model
	 */
	private function createBill($data) {
		$bill = new BillModel();
		$bill->date = $data['date'];
		$bill->description = $data['description'];
		$bill->group = $data['group'];
		$bill->value = $data['value'];
		return $bill->save();
	}

	
}

?>