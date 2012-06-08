<?php

class CategoryController extends Zend_Controller_Action
{
    public $category_type1 = "aaaaa";

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $category_id = $this->_request->getParam('category_id');
        $page = $this->_request->getParam('page');
        $pageSize = 2;
        $this->view->category_type = $this->_request->getParam('category');
        $this->view->category_id = $category_id;

        switch ($this->view->category_type) {
        	case 'app':
        		$parent_category_id = 1;
        		break;
       		case 'game':
        		$parent_category_id = 2;
        		break;
        	case 'topic':
        		$parent_category_id = 3;
        		break;
        	default:
        		# code...
        		break;
        }
		
		// get categories which parent_id is the same with $category_id	   	
        $categories = new Application_Model_DbTable_Categories();
        $this->view->categories = $categories->getByParentId($parent_category_id);
        $this->view->category = $categories->getById($category_id);

        // get apps which category equal $category_id
        $apps = new Application_Model_DbTable_AppCategories();
        $this->view->apps = $apps->getByCategory($category_id, $page, $pageSize);
        $app_count = $apps->getAppCountByCategory($category_id)->app_count;
        
        $this->view->totalPage = ceil($app_count/$pageSize);
        $this->view->currentPage = $page;
    }
}

