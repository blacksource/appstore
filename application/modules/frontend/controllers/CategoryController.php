<?php

class CategoryController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {       
        $category_id = $this->_request->getParam('category_id');
        $apps = new Application_Model_DbTable_Apps();
        $this->view->apps = $apps->getPageByCategory($category_id, 1, 20);
        $this->view->totalPage = 0;

        // get category by app`s category_id
        $categories = new Application_Model_DbTable_Categories();
        $this->view->category = $categories->getById($category_id);
    }

    public function gameAction()
    {        
        $page = $this->_request->getParam('page') == "" ? 1 : $this->_request->getParam('page');
        $pageSize = 20;

        $apps = new Application_Model_DbTable_Apps();
        $app_count = $apps->getCountByParentCategory(2);
        $this->view->totalPage = 0;//ceil($app_count/$pageSize);
        $this->view->games = $apps->getPageByParentCategory(2, $page, $pageSize);
    
    }

    public function appAction()
    {        
        $page = $this->_request->getParam('page') == "" ? 1 : $this->_request->getParam('page');
        $pageSize = 20;

        $apps = new Application_Model_DbTable_Apps();
        $app_count = $apps->getCountByParentCategory(1);
        $this->view->totalPage = 0;//ceil($app_count/$pageSize);
        $this->view->apps = $apps->getPageByParentCategory(1, $page, $pageSize);
    
    }

    public function subjectAction()
    {
    }

    public function topAction()
    {
    }
}

