<?php

class Application_Form_App extends Zend_Form
{

    public function init()
    {
        $this->setName('app');

        $type_name = new Zend_Form_Element_Select('type_name');
        $type_name->setLabel('type_name')
                  ->setRequired(true)
                  ->addMultiOptions(array('android' => 'android',
                                          'iphone' => 'iphone',
                                          'ipad' => 'ipad'));  

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
        	 ->addValidator('NotEmpty');

        $category_id = new Zend_Form_Element_Select('category_id');
        $category_id->setLabel('category_id');

        $logo = new Zend_Form_Element_Text('logo');
        $logo->setLabel('logo');

        $price = new Zend_Form_Element_Text('price');
        $price->setLabel('price');


        $version = new Zend_Form_Element_Text('version');
        $version->setLabel('version');

        $developer = new Zend_Form_Element_Text('developer');
        $developer->setLabel('developer');

        $star = new Zend_Form_Element_Text('star');
        $star->setLabel('star');

        $language = new Zend_Form_Element_Text('language');
        $language->setLabel('language');

        $size = new Zend_Form_Element_Text('size');
        $size->setLabel('size');

        $download_times = new Zend_Form_Element_Text('download_times');
        $download_times->setLabel('download_times');

        $app_path = new Zend_Form_Element_Text('app_path');
        $app_path->setLabel('app_path');

        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('description');

        $created_at = new Zend_Form_Element_Text('created_at');
        $created_at->setLabel('created_at');
        $created_at->setValue(date('Y-m-d H:i:s',time()));


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add');

        $this->addElements(array($type_name, $name, $category_id, $logo, $price, $version, $developer, $star, $language, $size, $download_times, $app_path, $description, $created_at, $submit));

        // add category options
        $categories = new Application_Model_DbTable_Categories();
        $cs = $categories->getAll();
        $cs_options = array();
        foreach ($cs as $c) 
        {
                array_push($cs_options, array($c->id => $c->type_name.'-'.$c->name));
        }
        $category_id->addMultiOptions($cs_options);       
    }
}

