<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "t_user"
 * in 2012-12-22
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package models
 *
 */

class User extends Lumine_Base {

    
    public $id;
    public $name;
    public $surname;
    public $displayname;
    public $status;
    public $username;
    public $password;
    public $photo;
    public $balances = array();
    public $balances1 = array();
    public $debit = array();
    public $debit1 = array();
    public $expenses = array();
    public $payment = array();
    public $payment1 = array();
    public $group = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_user');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('name', 'NAME', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('surname', 'SURNAME', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('displayname', 'DISPLAYNAME', 'varchar', 45, array());
        $this->metadata()->addField('status', 'STATUS', 'int', 11, array('notnull' => true));
        $this->metadata()->addField('username', 'USERNAME', 'varchar', 100, array('notnull' => true));
        $this->metadata()->addField('password', 'PASSWORD', 'varchar', 100, array('notnull' => true));
        $this->metadata()->addField('photo', 'PHOTO', 'blob', 65535, array());

        
        $this->metadata()->addRelation('balances', Lumine_Metadata::ONE_TO_MANY, 'Balance', 'fromId', null, null, null);
        $this->metadata()->addRelation('balances1', Lumine_Metadata::ONE_TO_MANY, 'Balance', 'toId', null, null, null);
        $this->metadata()->addRelation('debit', Lumine_Metadata::ONE_TO_MANY, 'Debit', 'fromId', null, null, null);
        $this->metadata()->addRelation('debit1', Lumine_Metadata::ONE_TO_MANY, 'Debit', 'toId', null, null, null);
        $this->metadata()->addRelation('expenses', Lumine_Metadata::ONE_TO_MANY, 'Expense', 'userId', null, null, null);
        $this->metadata()->addRelation('payment', Lumine_Metadata::ONE_TO_MANY, 'Payment', 'fromId', null, null, null);
        $this->metadata()->addRelation('payment1', Lumine_Metadata::ONE_TO_MANY, 'Payment', 'toId', null, null, null);
        $this->metadata()->addRelation('group', Lumine_Metadata::MANY_TO_MANY, 'Group', 'id', 't_user_t_group', 'USER_ID', null);
    }

    #### END AUTOCODE


}
