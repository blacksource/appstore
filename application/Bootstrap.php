<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initRouter()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();

		$router->addRoute('topic', new Zend_Controller_Router_Route_Regex(
					    '(topic|application|game).html',
					    array(
					        'controller' => 'category',
					        'action'     => 'index'
					    ),
					    array(
					    	1 => 'category'
					    ),
					    '%s.html'
					));
		
		$router->addRoute('topic', new Zend_Controller_Router_Route_Regex(
					    '(topic|app|game)_(\d+)_(\d+)\.html',
					    array(
					        'controller' => 'category',
					        'action'     => 'index'
					    ),
					    array(
					    	1 => 'category',
					    	2 => 'category_id',
					    	3 => 'page'
					    ),
					    '%s.html'
					));

        $router->addRoute('download',
                  new Zend_Controller_Router_Route('download/:id', 
                  					array('controller' => 'download',
                  							'action' => 'index')));

		$router->addRoute('app', new Zend_Controller_Router_Route_Regex(
					    'app/(\d+)\.html',
					    array(
					        'controller' => 'app',
					        'action'     => 'show'
					    ),
					    array(
					        1 => 'id'
					    ),
					    'app/%d.html'
					));


    }
}

