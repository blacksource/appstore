<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_redirect('android.html');
        $this->render('android');
        $this->view->type_name = "android";
    }

    public function iphoneAction()
    {      
        $this->_helper->layout->setLayout('iphone');
        $this->view->type_name = $this->getRequest()->getActionName();   
    }

    public function androidAction()
    {
        $this->_helper->layout->setLayout('android');

        /*
        $recommendApps = new Application_Model_DbTable_RecommendApps();
        // get install_recommend
        $this->views->recommend_games = $recommendApps->getTopByType('game', 12);
        
        // get app_recommend
        $this->views->recommend_apps = $recommendApps->getTopByType('game', 12);
        
        // get new_recommend
        $this->views->recommend_news = $recommendApps->getTopByType('game', 12);
        */

        // get game top
        $apps = new Application_Model_DbTable_Apps();
        $this->view->games = $apps->getByParentCategory(2);
        
        // get app top

        //
    }
}

