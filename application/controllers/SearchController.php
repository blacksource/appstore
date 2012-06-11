<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$keywords = $this->_request->getParam('keywords');
    	
    	$apps = new Application_Model_DbTable_Apps();
    	$results = $apps->search($keywords);

    	var_dump($results);

    }
}