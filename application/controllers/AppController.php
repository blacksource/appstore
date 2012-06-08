<?php

class AppController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function showAction()
    {
    	$id = $this->_request->getParam('id');
        
        $apps = new Application_Model_DbTable_Apps();
        $this->view->app = $apps->getApp($id);
        $category_id = $this->view->app->category_id;
        $this->view->otherVersions = $apps->getByName($this->view->app->name);
        $this->view->relateds = $apps->getRelatedsByCategory($category_id);

        $app_imgs = new Application_Model_DbTable_AppImgs();
        $this->view->imgs = $app_imgs->getAppImgs($id);

        $categories = new Application_Model_DbTable_Categories();
        $this->view->category = $categories->getById($category_id);

        $recommendApps = new Application_Model_DbTable_RecommendApps();
        $this->view->recommends = $recommendApps->getByCategory($category_id, 10);
    }

    public function addAction()
    {
        $form = new Application_Form_App();
        $form->submit->setLabel('Add');

        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) 
            {
                $app = $form->getValues();

                $apps = new Application_Model_DbTable_Apps();
                echo $apps->add($app);

                echo 'save success';
            }
        }
    }
}

