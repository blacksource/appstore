<?php

class CategoryController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {       
        $this->view->type_name =$this->_request->getParam('type_name');
        $category_id = $this->_request->getParam('category_id');
        $page = $this->_request->getParam('page') == "" ? 1 : $this->_request->getParam('page');
        $pageSize = 2;
        $this->view->category_type = $this->_request->getParam('category');

		// get categories which parent_id is the same with $category_id	   	
        $categories = new Application_Model_DbTable_Categories();
        $this->view->categories = $categories->getByParentEnglishName($this->view->type_name, $this->view->category_type);

        if(count($this->view->categories) == 0)
        {
            return;
        }
        if("" == $category_id)
        {
            $category_id = $this->view->categories->current()->id;            
        }
        $this->view->category_id = $category_id;
        $this->view->category = $categories->getById($category_id);

        // get apps which category equal $category_id
        $apps = new Application_Model_DbTable_AppCategories();
        $this->view->apps = $apps->getByCategory($category_id, $page, $pageSize);
        $app_count = $apps->getAppCountByCategory($category_id)->app_count;
        
        $this->view->totalPage = ceil($app_count/$pageSize);
        $this->view->currentPage = $page;
    }

    public function gameAction()
    {
        $this->_helper->layout->setLayout('android');  
        
        $page = $this->_request->getParam('page') == "" ? 1 : $this->_request->getParam('page');
        $pageSize = 20;

        $apps = new Application_Model_DbTable_Apps();
        $app_count = $apps->getCountByParentCategory(2);
        $this->view->totalPage = 0;//ceil($app_count/$pageSize);
        $this->view->games = $apps->getPageByParentCategory(2, $page, $pageSize);
    
    }

    public function appAction()
    {
        $this->_helper->layout->setLayout('android');  
        
        $page = $this->_request->getParam('page') == "" ? 1 : $this->_request->getParam('page');
        $pageSize = 20;

        $apps = new Application_Model_DbTable_Apps();
        $app_count = $apps->getCountByParentCategory(1);
        $this->view->totalPage = 0;//ceil($app_count/$pageSize);
        $this->view->apps = $apps->getPageByParentCategory(1, $page, $pageSize);
    
    }

    public function subjectAction()
    {
        $this->_helper->layout->setLayout('android');
    }

    public function topAction()
    {
        $this->_helper->layout->setLayout('android');
    }
}

