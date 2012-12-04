<?php

class Expense extends Lumine_Base {

	public $id;
	public $activity;
	public $user;
	public $value;

	protected function _initialize() {
		$this->metadata()->setTablename('t_expense');
		$this->metadata()->setPackage('system.application.models.dao');

		# nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes

		$this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
		$this->metadata()->addField('activity', 'ACTIVITY_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Activity'));
		$this->metadata()->addField('user', 'USER_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'User'));
		$this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));

	}

}
