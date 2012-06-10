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
        $this->view->app = $apps->getById($id);
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


    // admin/
    public function addAction()
    {
        $this->_helper->layout->setLayout('admin');
        $form = new Application_Form_App();
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) 
            {
                $app = $form->getValues();
                $apps = new Application_Model_DbTable_Apps();
                // array_push($app, array('created_at'=>date('Y-m-d H:i:s',time())));
                $app_id = $apps->save($app);

                // save app_category
                $app_categories = new Application_Model_DbTable_AppCategories();
                $app_category = array('app_id'=>$app_id,
                                      'category_id'=>$form->getValue('category_id'),
                                      'created_at'=>date('Y-m-d H:i:s',time()));
                $app_categories->save($app_category);

                echo 'save success id='.$app_id;
            }
        }
    }
}

