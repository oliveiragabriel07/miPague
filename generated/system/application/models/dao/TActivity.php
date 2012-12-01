<?php

class TActivity extends Lumine_Base {

    
    public $id;
    public $groupId;
    public $activityType;
    public $value;
    public $date;
    public $desc;
    public $texpenses = array();
    public $trepayment = array();
    
      protected function _initialize()
    {
        $this->metadata()->setTablename('t_activity');
        $this->metadata()->setPackage('system.application.models.dao');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('groupId', 'GROUP_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TGroup'));
        $this->metadata()->addField('activityType', 'ACTIVITY_TYPE', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));
        $this->metadata()->addField('date', 'DATE', 'date', null, array('notnull' => true));
        $this->metadata()->addField('desc', 'DESC', 'varchar', 100, array());

        
        $this->metadata()->addRelation('texpenses', Lumine_Metadata::ONE_TO_MANY, 'TExpense', 'activityId', null, null, null);
        $this->metadata()->addRelation('trepayment', Lumine_Metadata::ONE_TO_MANY, 'TRepayment', 'activityId', null, null, null);
    }

}
