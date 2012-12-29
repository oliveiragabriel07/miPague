<?php

class BillModel extends Lumine_Base {

    public $id;
    public $group;
    public $value;
    public $date;
    public $description;
    public $debits = array();
    public $expenses = array();
    
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_bill');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('group', 'GROUP_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'GroupModel'));
        $this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));
        $this->metadata()->addField('date', 'DATE', 'date', null, array('notnull' => true));
        $this->metadata()->addField('description', 'DESCRIPTION', 'varchar', 100, array());

        
        $this->metadata()->addRelation('debits', Lumine_Metadata::ONE_TO_MANY, 'DebitModel', 'bill', null, null, null);
        $this->metadata()->addRelation('expenses', Lumine_Metadata::ONE_TO_MANY, 'ExpenseModel', 'bill', null, null, null);
    }

}
