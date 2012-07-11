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
        $this->view->type_name = "android";
    }

    public function iphoneAction()
    {      
        $this->_helper->layout->setLayout('iphone');
        $this->view->type_name = $this->getRequest()->getActionName();   
    }

    public function androidAction()
    {
        $recommendApps = new Application_Model_DbTable_RecommendApps();
        // get install_recommend
        $this->view->recommend_installs = $recommendApps->getTopByType('install', 12);
        // get game_recommend
        $this->view->recommend_games = $recommendApps->getTopByType('game', 12);
        // get new_recommend
        $this->view->recommend_news = $recommendApps->getTopByType('new', 12);

        // get game top
        $apps = new Application_Model_DbTable_Apps();
        $this->view->hot_games = $apps->getByParentCategory(2);
        
        // get app top
        $apps = new Application_Model_DbTable_Apps();
        $this->view->hot_apps = $apps->getByParentCategory(1);
        
        // hot category
        // $this->view->hot_categories = $apps->getByCategories(array(102,103,104,105,106,107));
        $hot_categoriy102 = $apps->getAppByCategory(102, 6);
        $hot_categoriy103 = $apps->getAppByCategory(103, 6);
        $hot_categoriy104 = $apps->getAppByCategory(104, 6);
        $hot_categoriy105 = $apps->getAppByCategory(105, 6);
        $hot_categoriy106 = $apps->getAppByCategory(106, 6);
        $hot_categoriy107 = $apps->getAppByCategory(107, 6);
        $this->view->hot_categories = array(102=>$hot_categoriy102, 103=>$hot_categoriy103, 
            104=>$hot_categoriy104, 105=>$hot_categoriy105, 106=>$hot_categoriy106,
            107=>$hot_categoriy107);
    }
}

