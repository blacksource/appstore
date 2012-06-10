<?php

class Application_Model_DbTable_AppCategories extends Zend_Db_Table_Abstract
{

    protected $_name = 'app_categories';

	public function getByCategory($category_id, $page, $pageSize)
    {
		$select = $this->select()
    		->setIntegrityCheck(false)
            ->from(array('c'=>'app_categories'), array('cid'=>'id'))
            ->joinLeft(array('a'=>'apps'), 'a.id=c.app_id')
            ->where('c.category_id=?', $category_id)
            ->limit($pageSize, ($page-1)*$pageSize);
        return $this->fetchAll($select);
    }

    public function getAppCountByCategory($category_id)
    {
        $select = $this->select()
    		->setIntegrityCheck(false)
            ->from(array('c'=>'app_categories'), array('app_count'=>'count(*)'))
            ->joinLeft(array('a'=>'apps'), 'a.id=c.app_id')
            ->where('c.category_id=?', $category_id);
        return $this->fetchRow($select);
    }

    public function save($app_category)
    {
        return $this->insert($app_category);
    }
}

