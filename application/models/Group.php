<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "t_group"
 * in 2012-12-22
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package models
 *
 */

class Group extends Lumine_Base {

    
    public $id;
    public $name;
    public $cls;
    public $balances = array();
    public $bill = array();
    public $useres = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_group');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('name', 'NAME', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('cls', 'CLS', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('balances', Lumine_Metadata::ONE_TO_MANY, 'Balance', 'groupId', null, null, null);
        $this->metadata()->addRelation('bill', Lumine_Metadata::ONE_TO_MANY, 'Bill', 'groupId', null, null, null);
        $this->metadata()->addRelation('useres', Lumine_Metadata::MANY_TO_MANY, 'User', 'id', 't_user_t_group', 'GROUP_ID', null);
    }

    #### END AUTOCODE


}
