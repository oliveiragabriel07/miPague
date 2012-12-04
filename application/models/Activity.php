<?php

class Activity extends Lumine_Base {

	public $id;
	public $group;
	public $activityType;
	public $value;
	public $date;
	public $desc;
	public $expenses = array();
	public $repayment = array();

	protected function _initialize() {
		$this->metadata()->setTablename('t_activity');
		$this->metadata()->setPackage('system.application.models.dao');

		# nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes

		$this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
		$this->metadata()->addField('group', 'GROUP_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Group'));
		$this->metadata()->addField('activityType', 'ACTIVITY_TYPE', 'varchar', 45, array('notnull' => true));
		$this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));
		$this->metadata()->addField('date', 'DATE', 'date', null, array('notnull' => true));
		$this->metadata()->addField('desc', 'DESC', 'varchar', 100, array());
		$this->metadata()->addRelation('expenses', Lumine_Metadata::ONE_TO_MANY, 'Expense', 'activity', null, null, null);
		$this->metadata()->addRelation('repayment', Lumine_Metadata::ONE_TO_MANY, 'Repayment', 'activity', null, null, null);
	}

}
