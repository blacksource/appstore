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
        $this->view->type_name =$this->_request->getParam('type_name');
        $category_id = $this->_request->getParam('category_id');
        $page = $this->_request->getParam('page') == "" ? 1 : $this->_request->getParam('page');
        $pageSize = 2;
        $this->view->category_type = $this->_request->getParam('category');

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

    public function addAction()
    {
        $this->_helper->layout->setLayout('admin');
        $form = new Application_Form_Category();
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) 
            {
                $category = $form->getValues();
                $categories = new Application_Model_DbTable_Categories();

                try {
                $category_id = $categories->save($category);
                    
                } catch (Exception $e) {
                    echo $e;
                }


                echo 'save success category_id='.$category_id;
            }
        }
    }
}

