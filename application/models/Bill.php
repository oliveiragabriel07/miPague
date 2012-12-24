<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "t_bill"
 * in 2012-12-22
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package models
 *
 */

class Bill extends Lumine_Base {

    
    public $id;
    public $groupId;
    public $value;
    public $date;
    public $desc;
    public $debit = array();
    public $expenses = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('t_bill');
        $this->metadata()->setPackage('models');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'ID', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('groupId', 'GROUP_ID', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Group'));
        $this->metadata()->addField('value', 'VALUE', 'double', null, array('notnull' => true));
        $this->metadata()->addField('date', 'DATE', 'date', null, array('notnull' => true));
        $this->metadata()->addField('desc', 'DESC', 'varchar', 100, array());

        
        $this->metadata()->addRelation('debit', Lumine_Metadata::ONE_TO_MANY, 'Debit', 'billId', null, null, null);
        $this->metadata()->addRelation('expenses', Lumine_Metadata::ONE_TO_MANY, 'Expense', 'billId', null, null, null);
    }

    #### END AUTOCODE


}
