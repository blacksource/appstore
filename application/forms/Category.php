<?php
class Application_Form_Category extends Zend_Form
{
    public function init()
    {
    	$this->setName('category');

        $type_name = new Zend_Form_Element_Select('type_name');
        $type_name->setLabel('type_name')
                  ->setRequired(true)
                  ->addMultiOptions(array('android' => 'android',
                                          'iphone' => 'iphone',
                                          'ipad' => 'ipad')); 

    	$name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
        	 ->addValidator('NotEmpty');

       	$parent_id = new Zend_Form_Element_Text('parent_id');
        $parent_id->setLabel('parent_id')
        	      ->addValidator('NotEmpty');

       	$icon = new Zend_Form_Element_Text('icon');
        $icon->setLabel('icon');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add');

        $this->addElements(array($type_name, $name, $parent_id, $icon, $submit));
    }
 }