<?php

class RecommendController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$type = $this->_request->getParam('type');

    	$recommendApps = new Application_Model_DbTable_RecommendApps();
    	$this->view->apps = $recommendApps->getByType($type);
    	$this->view->totalPage = 0;
    	switch ($type) {
    		case 'install':
    			$this->view->typeName = "装机";
    			break;
    		case 'game':
    			$this->view->typeName = "游戏";
    			break;
    		case 'new':
    			$this->view->typeName = "新品";
    			break;
    		default:
    			# code...
    			break;
    	}
    }
}