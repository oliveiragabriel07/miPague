<?php

class ExpenseModel extends Lumine_Base {
    
    public $id;
    public $bill;
    public $user;
    public $value;
    
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_expense');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('bill', 'BILL_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'BillModel'));
        $this->metadata()->addField('user', 'USER_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'UserModel'));
        $this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));
    }

}
