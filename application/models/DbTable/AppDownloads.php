<?php

class Application_Model_DbTable_AppDownloads extends Zend_Db_Table_Abstract
{

    protected $_name = 'app_downloads';

    public function add($app_download)
    {
    	try {
    	$this->insert($app_download);
    		
    	} catch (Exception $e) {
    		echo $e;
    	}
    }
}

