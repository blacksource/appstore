<?php
class Backend_AuthController extends Zend_Controller_Action
{
	public function loginAction()
	{
		//Zend Framework 特性之 Zend_Auth   http://hi.baidu.com/nwuzy/blog/item/a8b6b38b48e228679f2fb460.html
		$this->_helper->layout->setLayout('admin');
	    $form = new Application_Form_Login();
	    $this->view->form = $form;

	    if($this->getRequest()->isPost())
	    {
	    	$userName = $this->getRequest()->getParam("user_name");
	    	$password = $this->getRequest()->getParam("password");
	    	
	    	if($userName=="blacksource" && $password=="admin_123456")
		    {
		    	setcookie("userName", "blacksource", time()+24*3600, '/');
		    	echo "login success";
		    }
	    }
	}
}