<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$word = $this->_request->getParam('wd');

    	$apps = new Application_Model_DbTable_Apps();
    	$this->view->apps = $apps->search($word);
    	$this->view->totalPage = 0;
    }
}