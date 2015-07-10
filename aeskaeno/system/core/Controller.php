<?php

namespace aeskaeno\system\core;


use Zend\ServiceManager\ServiceManager;

/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 19:18
 */

  class Controller  {

     protected $layout = true;
     protected $serviceManager;
     protected $request;

     public final function  __construct() {
        $this->serviceManager = new ServiceManager();
        $this->request = new Request();
        $this->init();
     }

     public function view($view = null,Array $dados = array())
     {
         if(null === $view)
         {
             $view = $this->request->getAction();
         }
         extract($dados,EXTR_OVERWRITE);

         if(file_exists('../aeskaeno/app/view/'.strtolower($this->request->getController()).'/'.$view.'.phtml')){
             $return = '';
             if($this->layout){
                 $return .= include_once('../aeskaeno/app/view/layout/header.phtml');

                 $return .= include_once('../aeskaeno/app/view/'.strtolower($this->request->getController()).'/'.$view.'.phtml');

                 $return .= include_once('../aeskaeno/app/view/layout/footer.phtml');
             } else {
                 $return .= include_once('../aeskaeno/app/view/'.strtolower($this->request->getController()).'/'.$view.'.phtml');
             }

             return $return;
         }
         die("View solicitada não existe.");
     }

     public function disableLayout()
     {
         $this->layout = false;
     }

     public function enableLayout()
     {
         $this->layout = true;
     }

     public function getServiceLocator() {
         return $this->serviceManager;
     }

     protected function init() {}

     public function getParams($params = null, $return = null) {
         return $this->request->getParams($params, $return);
     }
}