<?php

class AppController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function showAction()
    {
        // get params
        $this->_helper->layout->setLayout('android_app');
        $this->view->type_name = $this->_request->getParam('type_name');
    	$id = $this->_request->getParam('id');
        
        // get app detail by app_id
        $apps = new Application_Model_DbTable_Apps();
        $this->view->app = $apps->getById($id);

        // get app images by app_id
        $app_imgs = new Application_Model_DbTable_AppImgs();
        $this->view->imgs = $app_imgs->getAppImgs($id);

        // get category by app`s category_id
        $category_id = $this->view->app->category_id;
        $categories = new Application_Model_DbTable_Categories();
        $this->view->category = $categories->getById($category_id);
    }
}

