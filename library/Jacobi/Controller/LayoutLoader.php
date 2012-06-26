<?php
class Jacobi_Controller_LayoutLoader
    extends Zend_Controller_plugin_Abstract
{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $bootstrap=$this->getActionController()->getInvokeArg('bootstrap');
        $config=$bootstrap->getOptions();
        $module=$this->getRequest()->getModuleName();
        if(isset($config[$module]['resources']['layout']['layoutPath']))
        {
            $layoutPath=$config[$module]['resources']['layout']['layoutPath'];
            $this->getActionController()->getHelper('layout')->setLayoutPath($layoutPath);
        }
    }
}