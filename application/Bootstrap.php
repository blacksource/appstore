<?php

// require '../library/Jacobi/Controller/LayoutLoader.php'; 

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initRouter()
    {
    	Zend_Controller_Action_HelperBroker::addPrefix('Jacobi_Helper');

    	$frontController = Zend_Controller_Front::getInstance();
    	$frontController->addModuleDirectory('../application/modules');
   //  	$frontController->setControllerDirectory(array(
			//     'default'    => '../application/modules/frontend/controllers',
			//     'admin'    => '../application/modules/backend/controllers',
			// ));
		$frontController->setDefaultModule('frontend');
		// $frontController->registerPlugin(new Jacobi_Controller_Action_Helper_LayoutLoader());

        $router = $frontController->getRouter();

        $router->addRoute('android_html',
                  new Zend_Controller_Router_Route('android.html', 
                  					array('controller' => 'index',
                  							'action' => 'android')));

        $router->addRoute('iphone_html',
                  new Zend_Controller_Router_Route('iphone.html', 
                  					array('controller' => 'index',
                  							'action' => 'iphone')));

		$router->addRoute('game_html', new Zend_Controller_Router_Route_Regex(
		    '(android|iphone|ipad)/game.html',
		    array(
		        'controller' => 'category',
		        'action'     => 'game'
		    ),
		    '%s.html'
		));

		$router->addRoute('app_html', new Zend_Controller_Router_Route_Regex(
		    '(android|iphone|ipad)/app.html',
		    array(
		        'controller' => 'category',
		        'action'     => 'app'
		    ),
		    '%s.html'
		));

		$router->addRoute('recommend_html', new Zend_Controller_Router_Route_Regex(
		    '(android|iphone|ipad)/(install|game|new)_recommend.html',
		    array(
		        'controller' => 'recommend',
		        'action'     => 'index'
		    ),
		    array(
		    	1 => 'type_name',
		    	2 => 'type',
		    ),
		    '%s.html'
		));

		$router->addRoute('subject_html', new Zend_Controller_Router_Route_Regex(
		    '(android|iphone|ipad)/subject.html',
		    array(
		        'controller' => 'category',
		        'action'     => 'subject'
		    ),
		    '%s.html'
		));
		$router->addRoute('top_html', new Zend_Controller_Router_Route_Regex(
		    '(android|iphone|ipad)/top.html',
		    array(
		        'controller' => 'category',
		        'action'     => 'top'
		    ),
		    '%s.html'
		));

		$router->addRoute('category', new Zend_Controller_Router_Route_Regex(
			    '(android|iphone|ipad)/(topic|app|game)_(\d+)_(\d+)\.html',
			    array(
			        'controller' => 'category',
			        'action'     => 'index'
			    ),
			    array(
			    	1 => 'type_name',
			    	2 => 'category',
			    	3 => 'category_id',
			    	4 => 'page'
			    ),
			    '%s.html'
			));

		// $router->addRoute('topic', new Zend_Controller_Router_Route_Regex(
		// 			    '(android|iphone|ipad)/(topic|app|game).html',
		// 			    array(
		// 			        'controller' => 'category',
		// 			        'action'     => 'index'
		// 			    ),
		// 			    array(
		// 			    	1 => 'type_name',
		// 			    	2 => 'category'
		// 			    ),
		// 			    '%s.html'
		// 			));
		

		// $router->addRoute('category', new Zend_Controller_Router_Route_Regex(
		// 			    '(android|iphone|ipad)/(topic|app|game)_(\d+)_(\d+)\.html',
		// 			    array(
		// 			        'controller' => 'category',
		// 			        'action'     => 'index'
		// 			    ),
		// 			    array(
		// 			    	1 => 'type_name',
		// 			    	2 => 'category',
		// 			    	3 => 'category_id',
		// 			    	4 => 'page'
		// 			    ),
		// 			    '%s.html'
		// 			));

		$router->addRoute('app', new Zend_Controller_Router_Route_Regex(
					    '(android|iphone|ipad)/app/(\d+)\.html',
					    array(
					        'controller' => 'app',
					        'action'     => 'show'
					    ),
					    array(
					    	1 => 'type_name',
					        2 => 'id'
					    ),
					    'app/%d.html'
					));



        $router->addRoute('download',
                  new Zend_Controller_Router_Route('download/:id', 
                  					array('controller' => 'download',
                  							'action' => 'index')));

        // admin
		$router->addRoute('app_add',
                  new Zend_Controller_Router_Route('admin/app/add', 
                  					array('controller' => 'app',
                  							'action' => 'add')));

		$router->addRoute('category_add',
                  new Zend_Controller_Router_Route('admin/category/add', 
                  					array('controller' => 'category',
                  							'action' => 'add')));
    }

    protected function _initLayoutHelper()
	{
		try {
			$this->bootstrap('frontController');
			// new Jacobi_Controller_Action_Helper_LayoutLoader();
		} catch (Exception $e) {
			echo  $e;
		}
		
	}
}

