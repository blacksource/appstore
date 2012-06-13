<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->render('android');
        $this->view->type_name = "android";
    }

    public function iphoneAction()
    {      
        $this->_helper->layout->setLayout('home');
        $this->view->type_name = $this->getRequest()->getActionName();   
    }

    public function androidAction()
    {
        $this->_helper->layout->setLayout('android');
        $this->view->type_name = $this->getRequest()->getActionName();
    }
}

