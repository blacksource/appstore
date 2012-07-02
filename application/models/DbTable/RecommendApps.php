<?php

class Application_Model_DbTable_RecommendApps extends Zend_Db_Table_Abstract
{

    protected $_name = 'recommend_apps';

    public function getTopByType($type, $limit)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('id', 'name', 'star', 'logo', 'price', 'comment', 'download_times'))
            ->joinLeft(array('c'=>'categories'), 'a.category_id=c.id', array('category_name'=>'name'))
            ->joinLeft(array('r'=>'recommend_apps'), 'a.id=r.app_id', array('rid'=>'id'))
            ->where('r.type=?', $type)
            ->limit($limit);
        return $this->fetchAll($select);
    }

    public function getByType($type)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('id', 'name', 'star', 'logo', 'download_times'))
            ->joinLeft(array('r'=>'recommend_apps'), 'a.id=r.app_id')
            ->where('r.type=?', $type);
        return $this->fetchAll($select);
    }

    /*
    public function getByCategory($category_id, $limit)
    {
    	try {
    		$select = $this->select()
    			->setIntegrityCheck(false)
        		->from(array('r'=>'recommend_apps'), array('app_id'))
        		->joinLeft(array('a'=>'apps'), 'a.id=r.app_id', 
        					array('logo', 'name'))
                ->where('r.category_id=?', $category_id)
                ->order('r.created_at DESC')
                ->limit($limit);
            return $this->fetchAll($select);	
    	} catch (Exception $e) {
    		echo $e;
    	}
         
    }

    // get recommend apps by type('game','app','new')
    public function getTopByType($type, $limit)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('r'=>'recommend_apps'), array('app_id'))
            ->joinLeft(array('a'=>'apps'), 'a.id=r.app_id', 
                        array('logo', 'name'))
            ->where('r.type=?', $type)
            ->order('r.created_at DESC')
            ->limit($limit);
        return $this->fetchAll($select);
    }
    */
}

