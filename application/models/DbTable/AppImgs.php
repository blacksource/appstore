<?php

class Application_Model_DbTable_AppImgs extends Zend_Db_Table_Abstract
{

    protected $_name = 'app_imgs';

    public function getAppImgs($app_id)
    {
    	$select = $this->select()
                ->where('app_id=?', $app_id);
        return $this->fetchAll($select);
    }

    public function save($appImg)
    {
        return $this->insert($appImg);
    }
}

