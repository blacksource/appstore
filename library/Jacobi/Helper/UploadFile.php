<?php
class Jacobi_Helper_UploadFile extends Zend_Controller_Action_Helper_Abstract
{
	// upload file
	public function upload($uploadFile, $appType)
	{
		if($uploadFile['type'] == "image/jpeg" ||
            $uploadFile['type'] == "image/png" || 
            $uploadFile['type'] == "image/gif")
        {
            $typePath = "imgs";
            $fileName = date('Ymdhis').floor(microtime()*1000).strrchr($uploadFile['name'], '.');
        }
        else
        {
            $typePath = "apps";
            $fileName = $uploadFile['name'];
        }
        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $picPath = '/upload/'.$appType.'/'.$typePath.'/';

        if(!move_uploaded_file($uploadFile['tmp_name'], $rootPath.$picPath.$fileName))
        {
            return;
        }
        else
        {
            return $picPath.$fileName;
        }
	}

	public function direct($uploadFile, $appType)
    {
        return $this->upload($uploadFile, $appType);
    }
}