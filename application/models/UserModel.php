<?php
class UserModel extends Lumine_Base {
    
    public $id;
    public $name;
    public $surname;
    public $displayname;
    public $status;
    public $username;
    public $password;
    public $photo;
    public $balancesFrom = array();
    public $balancesTo = array();
    public $debitsFrom = array();
    public $debitsTo = array();
    public $expenses = array();
    public $paymentsFrom = array();
    public $paymentsTo = array();
    public $groups = array();
    
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_user');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('name', 'NAME', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('surname', 'SURNAME', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('displayname', 'DISPLAYNAME', 'varchar', 45, array());
        $this->metadata()->addField('status', 'STATUS', 'int', 11, array('notnull' => true));
        $this->metadata()->addField('username', 'USERNAME', 'varchar', 100, array('notnull' => true));
        $this->metadata()->addField('password', 'PASSWORD', 'varchar', 100, array('notnull' => true));
        $this->metadata()->addField('photo', 'PHOTO', 'blob', 65535, array());

        
        $this->metadata()->addRelation('balancesFrom', Lumine_Metadata::ONE_TO_MANY, 'BalanceModel', 'from', null, null, null);
        $this->metadata()->addRelation('balancesTo', Lumine_Metadata::ONE_TO_MANY, 'BalanceModel', 'to', null, null, null);
        $this->metadata()->addRelation('debitsFrom', Lumine_Metadata::ONE_TO_MANY, 'DebitModel', 'from', null, null, null);
        $this->metadata()->addRelation('debitsTo', Lumine_Metadata::ONE_TO_MANY, 'DebitModel', 'to', null, null, null);
        $this->metadata()->addRelation('expenses', Lumine_Metadata::ONE_TO_MANY, 'ExpenseModel', 'user', null, null, null);
        $this->metadata()->addRelation('paymentsFrom', Lumine_Metadata::ONE_TO_MANY, 'PaymentModel', 'from', null, null, null);
        $this->metadata()->addRelation('paymentsTo', Lumine_Metadata::ONE_TO_MANY, 'PaymentModel', 'to', null, null, null);
        $this->metadata()->addRelation('groups', Lumine_Metadata::MANY_TO_MANY, 'GroupModel', 'id', 't_user_t_group', 'USER_ID', null);
    }
}
