<?php

class UserGroup extends Lumine_Base {

    
    public $group;
    public $user;
    
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_user_group');
        $this->metadata()->setPackage('system.application.models.dao');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('group', 'GROUP_ID', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Group'));
        $this->metadata()->addField('user', 'USER_ID', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'User'));

        
    }

}
