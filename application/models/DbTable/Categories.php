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


    	    /*
    select c1.parent_id, c2.name as parent_name, c1.id, c1.name 
from categories c1, categories c2 where c1.parent_id = c2.id and c1.id = 4
*/
    }

    public function getByParentId($parent_id)
    {
        $select = $this->select()
                    ->where('parent_id=?', $parent_id);
       return $this->fetchAll($select);
    }

    public function getAll()
    {
        $select = $this->select()
                       ->from(array('c'=> 'categories'), array('id','type_name', 'name'))
                       ->order('type_name');
        return $this->fetchAll($select);
    }

    public function save($category)
    {
        return $this->insert($category);
    }
}

