<?php
class Backend_AppController extends Zend_Controller_Action
{
    // admin/
    public function addAction()
    {
    	// auth
    	if($_COOKIE['userName'] != "blacksource")
        {
            $this->_redirect("backend/auth/login");
        };

        $this->_helper->layout->setLayout('admin');
        $form = new Application_Form_App();
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) 
            {
                $app = $form->getValues();
                $apps = new Application_Model_DbTable_Apps();
                // array_push($app, array('created_at'=>date('Y-m-d H:i:s',time())));
                $appId = $apps->save($app);

                // save app_category
                $appCategories = new Application_Model_DbTable_AppCategories();
                $appCategory = array('app_id'=>$appId,
                                      'category_id'=>$form->getValue('category_id'),
                                      'created_at'=>date('Y-m-d H:i:s',time()));
                $appCategories->save($appCategory);

                echo 'save success id='.$appId;

                $this->view->appId = $appId;
            }
        }
    }

    public function filesAction()
    {
        // auth
        if($_COOKIE['userName'] != "blacksource")
        {
            $this->_redirect("backend/auth/login");
        };
        $this->_helper->layout->setLayout('admin');

        $request = $this->getRequest();
        if($request->isPost())
        {
            $appId = $request->getParam("id");
            // get app type(android,iphone)
            $apps = new Application_Model_DbTable_Apps();
            $app = $apps->getById($appId);

            // upload app
            $appPath = $this->_helper->UploadFile($_FILES["appPath"], $app->type_name);
            // upload icon
            $logoPath = $this->_helper->UploadFile($_FILES["appLogo"], $app->type_name);
            // update app and icon
            if($appPath != "" || $logoPath != "")
            {
                if($appPath != "" && $logoPath == "")
                {
                    $appData = array('app_path'=>$appPath);    
                }
                elseif ($appPath == "" && $logoPath != "") 
                {
                    $appData = array('logo'=>$logoPath);
                }
                else
                {
                    $appData = array('logo'=>$logoPath, 'app_path'=>$appPath);    
                }
                $apps->updateProperties($appId, $appData);    
            }

            // upload images
            $imgFiles = $_FILES["appImgs"];
            for ($i=0; $i < 6; $i++) { 
                if($imgFiles["name"][$i] == "")
                {
                    continue;
                }
                $imgFile = array("type"=>$imgFiles["type"][$i], 
                                "name"=>$imgFiles["name"][$i],
                                "tmp_name"=>$imgFiles["tmp_name"][$i]);
                $imgPath = $this->_helper->UploadFile($imgFile, $app->type_name);
                $appImgs = new Application_Model_DbTable_AppImgs();
                $appImg = array('app_id'=>$appId, 'img_path'=>$imgPath, 'created_at'=>date('Y-m-d h:i:s'));
                $appImgs->save($appImg);
            }
            echo "save success";
        }
    }


    public function recommendAction()
    {
        if($_COOKIE['userName'] != "blacksource")
        {
            $this->_redirect("backend/auth/login");
        };
        $this->_helper->layout->setLayout('admin');

        $request = $this->getRequest();
        if($request->isPost())
        {
            $appId = $request->getParam("id");
        }
    }
}