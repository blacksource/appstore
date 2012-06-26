<?php
class Application_Form_Login extends Zend_Form
{
	public function init()
	{
		$this->setName('login');

		$user_name = new Zend_Form_Element_Text('user_name');
		$user_name->setLabel('user_name');

		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('password');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Login');

		$this->addElements(array($user_name, $password, $submit));
	}
}