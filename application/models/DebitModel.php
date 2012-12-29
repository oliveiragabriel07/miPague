<?php
class DebitModel extends Lumine_Base {

    public $id;
    public $bill;
    public $from;
    public $to;
    public $status;
    public $value;
    public $pending;
    
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_debit');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true));
        $this->metadata()->addField('bill', 'BILL_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'BillModel'));
        $this->metadata()->addField('from', 'FROM_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'UserModel'));
        $this->metadata()->addField('to', 'TO_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'UserModel'));
        $this->metadata()->addField('status', 'STATUS', 'int', 11, array('notnull' => true));
        $this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));
        $this->metadata()->addField('pending', 'PENDING', 'double', null, array('notnull' => true));
    }

}
