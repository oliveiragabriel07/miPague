<?php
class GroupModel extends Lumine_Base {
    
    public $id;
    public $name;
    public $cls;
    public $balances = array();
    public $bills = array();
    public $users = array();

    protected function _initialize()
    {
        $this->metadata()->setTablename('t_group');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('name', 'NAME', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('cls', 'CLS', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('balances', Lumine_Metadata::ONE_TO_MANY, 'BalanceModel', 'group', null, null, null);
        $this->metadata()->addRelation('bills', Lumine_Metadata::ONE_TO_MANY, 'BillModel', 'group', null, null, null);
        $this->metadata()->addRelation('users', Lumine_Metadata::MANY_TO_MANY, 'UserModel', 'id', 't_user_t_group', 'GROUP_ID', null);
    }
    
    /**
     * Gets all group users
     * @param int $groupId
     * @return array <UserModel>
     */
    public static function getAllUsers($groupId) {
    	$group = new GroupModel();
    	$group->id = $groupId;
    	return $group->fetchLink('users');
    }
}
