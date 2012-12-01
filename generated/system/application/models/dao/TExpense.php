<?php

class TExpense extends Lumine_Base {

    
    public $id;
    public $activityId;
    public $userId;
    public $value;
    
      protected function _initialize()
    {
        $this->metadata()->setTablename('t_expense');
        $this->metadata()->setPackage('system.application.models.dao');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('activityId', 'ACTIVITY_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TActivity'));
        $this->metadata()->addField('userId', 'USER_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TUser'));
        $this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));

        
    }

}
