<?php

class TGroup extends Lumine_Base {

    
    public $id;
    public $name;
    public $class;
    public $tactivity = array();
    public $tusergroup = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_group');
        $this->metadata()->setPackage('system.application.models.dao');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('name', 'NAME', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('class', 'CLASS', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('tactivity', Lumine_Metadata::ONE_TO_MANY, 'TActivity', 'groupId', null, null, null);
        $this->metadata()->addRelation('tusergroup', Lumine_Metadata::ONE_TO_MANY, 'TUserGroup', 'groupId', null, null, null);
    }

}
