<?php

class TUserGroup extends Lumine_Base {

    
    public $groupId;
    public $userId;
    
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_user_group');
        $this->metadata()->setPackage('system.application.models.dao');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('groupId', 'GROUP_ID', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TGroup'));
        $this->metadata()->addField('userId', 'USER_ID', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TUser'));

        
    }

}
