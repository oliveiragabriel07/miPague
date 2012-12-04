<?php

class Repayment extends Lumine_Base {

	public $id;
	public $activity;
	public $from;
	public $to;
	public $receipt;
	public $status;
	public $value;
	public $pending;

	protected function _initialize() {
		$this->metadata()->setTablename('t_repayment');
		$this->metadata()->setPackage('system.application.models.dao');

		# nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes

		$this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true));
		$this->metadata()->addField('activity', 'ACTIVITY_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Activity'));
		$this->metadata()->addField('from', 'FROM_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'User'));
		$this->metadata()->addField('to', 'TO_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'User'));
		$this->metadata()->addField('receipt', 'RECEIPT', 'blob', 65535, array());
		$this->metadata()->addField('status', 'STATUS', 'int', 11, array('notnull' => true));
		$this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));
		$this->metadata()->addField('pending', 'PENDING', 'double', null, array('notnull' => true));

	}

}
