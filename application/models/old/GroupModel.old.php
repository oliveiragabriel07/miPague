<?php

class GroupModel extends Lumine_Base {

	public $id;
	public $name;
	public $class;
	public $activity = array();
	public $users = array();

	protected function _initialize() {
		$this->metadata()->setTablename('t_group');
		$this->metadata()->setPackage('system.application.models.dao');

		# nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes

		$this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
		$this->metadata()->addField('name', 'NAME', 'varchar', 45, array('notnull' => true));
		$this->metadata()->addField('class', 'CLASS', 'varchar', 45, array('notnull' => true));

		$this->metadata()->addRelation('activity', Lumine_Metadata::ONE_TO_MANY, 'ActivityModel', 'group', null, null, null);
		$this->metadata()->addRelation('users', Lumine_Metadata::MANY_TO_MANY, 'UserModel', 'id', 't_user_group', 'GROUP_ID', null);
	}

}
