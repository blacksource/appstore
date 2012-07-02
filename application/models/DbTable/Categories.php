<?php

class Application_Model_DbTable_Categories extends Zend_Db_Table_Abstract
{

    protected $_name = 'categories';

    public function getById($id)
    {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('c1'=>'categories'), array('id', 'name'))
                ->joinLeft(array('c2'=>'categories'), 'c2.id=c1.parent_id', 
                          array('parent_id'=>'id', 'parent_name'=>'name'))
                ->where('c1.id=?', $id);
        return $this->fetchRow($select);
    }
}

