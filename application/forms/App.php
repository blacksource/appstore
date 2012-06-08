<?php

class Application_Form_App extends Zend_Form
{

    public function init()
    {
        $this->setName('app');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
        	 ->addValidator('NotEmpty');

        $category_id = new Zend_Form_Element_Text('category_id');
        $category_id->setLabel('category_id');

        $logo = new Zend_Form_Element_Text('logo');
        $logo->setLabel('logo');

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

        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements(array($name, $category_id, $logo, $version, $developer, $star, $language, $size, $download_times, $app_path, $description, $submit));
    }


}

