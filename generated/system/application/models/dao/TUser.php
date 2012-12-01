<?php

class TUser extends Lumine_Base {

    
    public $id;
    public $name;
    public $surname;
    public $displayname;
    public $status;
    public $username;
    public $password;
    public $photo;
    public $texpenses = array();
    public $trepayment = array();
    public $trepayment1 = array();
    public $tusergroup = array();
    
    protected function _initialize()
    {
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

        
        $this->metadata()->addRelation('texpenses', Lumine_Metadata::ONE_TO_MANY, 'TExpense', 'userId', null, null, null);
        $this->metadata()->addRelation('trepayment', Lumine_Metadata::ONE_TO_MANY, 'TRepayment', 'toId', null, null, null);
        $this->metadata()->addRelation('trepayment1', Lumine_Metadata::ONE_TO_MANY, 'TRepayment', 'fromId', null, null, null);
        $this->metadata()->addRelation('tusergroup', Lumine_Metadata::ONE_TO_MANY, 'TUserGroup', 'userId', null, null, null);
    }

}
