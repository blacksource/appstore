<?php
class Backend_UploadController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$this->_helper->layout->setLayout('admin');

		$request = $this->getRequest();
		if($request->isPost())
		{
			$appType = $request->getParam('appType');

			if($_FILES['uploadFile']['type'] == "image/jpeg" ||
				$_FILES['uploadFile']['type'] == "image/png" || 
				$_FILES['uploadFile']['type'] == "image/gif")
			{
				$typePath = "pics";
				$fileName = date('Ymdhis').strrchr($_FILES['uploadFile']['name'], '.');
			}
			else
			{
				$typePath = "apps";
				$fileName = $_FILES['uploadFile']['name'];
			}
			$rootPath = $_SERVER['DOCUMENT_ROOT'];
			$picPath = '/upload/'.$appType.'/'.$typePath.'/';
			if(!move_uploaded_file($_FILES['uploadFile']['tmp_name'], $rootPath.$picPath.$fileName))
			{
				echo "upload filed";
			}
			else
			{
				echo $picPath.$fileName;
			}
		}
	}
}