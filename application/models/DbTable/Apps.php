<?php

class Application_Model_DbTable_Apps extends Zend_Db_Table_Abstract
{

    protected $_name = 'apps';

    public function getById($id)
    {
        $select = $this->select()
            ->where('id=?', $id);
        return $this->fetchRow($select);
    }

    public function getByName($name)
    {
        $select = $this->select()
                ->where('name=?', $name);
        return $this->fetchAll($select);
    }

    public function getRelatedsByCategory($category_id)
    {
        $select = $this->select()
                ->where('category_id=?', $category_id)
                ->order('RAND()')
                ->limit(10);
        return $this->fetchAll($select);   
    }

    // get app download path
    public function getAppPath($id)
    {
        $select = $this->select()
                ->where('id=?', $id);
        return $this->fetchRow($select);   
    }

    // add download_times
    public function addDownloadTimes($id, $count)
    {
        $data = array('download_times'=>new Zend_Db_Expr('download_times+'.$count));
        $this->update($data, 'id='.$id);
    }

    // update app properties
    public function updateProperties($id, $app)
    {
        $this->update($app, 'id='.$id);
    }

    public function save($app)
    {
        return $this->insert($app);
    }

    public function search($name)
    {
        $select = $this->select()
                ->where("name like '%?%'", $name);
        return $this->fetchAll($select);           
    }

}

