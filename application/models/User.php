<?php

class User extends Lumine_Base {

	public $id;
	public $name;
	public $surname;
	public $displayname;
	public $status;
	public $username;
	public $password;
	public $photo;
	public $expenses = array();
	public $repaymentTo = array();
	public $repaymentFrom = array();
	public $usergroup = array();

	protected function _initialize() {
		$this->metadata()->setTablename('t_user');
		$this->metadata()->setPackage('system.application.models.dao');

		# nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes

		$this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
		$this->metadata()->addField('name', 'NAME', 'varchar', 45, array('notnull' => true));
		$this->metadata()->addField('surname', 'SURNAME', 'varchar', 45, array('notnull' => true));
		$this->metadata()->addField('displayname', 'DISPLAYNAME', 'varchar', 45, array());
		$this->metadata()->addField('status', 'STATUS', 'int', 11, array('notnull' => true));
		$this->metadata()->addField('username', 'USERNAME', 'varchar', 100, array('notnull' => true));
		$this->metadata()->addField('password', 'PASSWORD', 'varchar', 100, array('notnull' => true));
		$this->metadata()->addField('photo', 'PHOTO', 'blob', 65535, array());

		$this->metadata()->addRelation('expenses', Lumine_Metadata::ONE_TO_MANY, 'Expense', 'user', null, null, null);
		$this->metadata()->addRelation('repaymentTo', Lumine_Metadata::ONE_TO_MANY, 'Repayment', 'to', null, null, null);
		$this->metadata()->addRelation('repaymentFrom', Lumine_Metadata::ONE_TO_MANY, 'Repayment', 'from', null, null, null);
		$this->metadata()->addRelation('usergroup', Lumine_Metadata::ONE_TO_MANY, 'UserGroup', 'user', null, null, null);
	}

}
