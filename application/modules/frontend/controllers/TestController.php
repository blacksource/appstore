<?php
class TestController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$this->_helper->layout->setLayout('android_app');

		$id = $this->_request->getParam('id');
		if($id == "")
		{
			return;
		}

		$apps = new Application_Model_DbTable_Apps();
        $this->view->app = $apps->getById($id);

        // get category by app`s category_id
        $category_id = $this->view->app->category_id;
        $categories = new Application_Model_DbTable_Categories();
        $this->view->category = $categories->getById($category_id);
	}

	public function categoryAction()
	{
		$this->_helper->layout->setLayout('admin');
		$ids = $this->_request->getParam('ids');
		if($ids == "")
		{
			return;
		}
		$idarray = explode(",", $ids);
		$apps = array();
		$appsDB = new Application_Model_DbTable_Apps();
		foreach ($idarray as $id) {
			$app = $appsDB->getById($id);
			array_push($apps, $app);
		}
		$this->view->apps = $apps;
	}
}