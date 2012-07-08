<?php

class Application_Model_DbTable_Apps extends Zend_Db_Table_Abstract
{

    protected $_name = 'apps';

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
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('id','name', 'logo', 'star', 'download_times'))
            ->joinLeft(array('c'=>'categories'), 'a.category_id=c.id', array('category_name'=>'name'))
            ->where("a.name like ?", '%'.$name.'%');
        return $this->fetchAll($select);

        // $sql="select a.id, a.name, a.logo, a.star, a.download_times, c.name as category_name from apps a inner join categories c on a.category_id=c.id ";
        // $sql = $sql."where a.name like '%".$name."%'";
        // // file_put_contents("c://a.txt",$sql); 
        // $sql=$this->_db->quoteInto($sql,'');
        // $result=$this->_db->query($sql);
        // $result=$result->fetchAll();
        // return $result;    
    }

    public function getByParentCategory($category_id)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('id','name', 'logo', 'star', 'download_times'))
            ->joinLeft(array('c'=>'categories'), 'a.category_id=c.id', array('category_name'=>'name'))
            ->where('c.parent_id=?', $category_id)
            ->limit(13);
        return $this->fetchAll($select);
    }

    public function getById($id)
    {
        $select = $this->select()
            ->where('id=?', $id);
        return $this->fetchRow($select);
    }

    public function getCountByParentCategory($category_id)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('app_count'=>'count(*)'))
            ->joinLeft(array('c'=>'categories'), 'a.category_id=c.id')
            ->where('c.parent_id=?', $category_id);
        return $this->fetchRow($select);
    }

    public function getPageByParentCategory($category_id, $page, $pageSize)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('id','name', 'logo', 'star', 'download_times'))
            ->joinLeft(array('c'=>'categories'), 'a.category_id=c.id', array('category_name'=>'name'))
            ->where('c.parent_id=?', $category_id)
            ->limit($pageSize, ($page-1)*$pageSize);
        return $this->fetchAll($select);
    }

    public function getByCategory($category_id, $limit)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('id','name', 'logo', 'star', 'download_times'))
            ->joinLeft(array('c'=>'app_categories'), 'a.id=c.app_id', array('cid'=>'category_id'))
            ->where('c.category_id=?', $category_id)
            ->limit($limit);
        return $this->fetchAll($select);
    }

    public function getPageByCategory($category_id, $page, $pageSize)
    {
        $select = $this->select()
            ->setIntegrityCheck(false)
            ->from(array('a'=>'apps'), array('id','name', 'logo', 'star', 'download_times'))
            ->joinLeft(array('c'=>'app_categories'), 'a.id=c.app_id', array('cid'=>'category_id'))
            ->where('c.category_id=?', $category_id)
            ->limit($pageSize, ($page-1)*$pageSize);
        return $this->fetchAll($select);
    }
}

