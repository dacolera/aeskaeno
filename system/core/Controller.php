<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 19:18
 */

 abstract class Controller {

     public $bootstrap;

     public function __construct()
     {
         $this->bootstrap = new Aeskaeno();
     }

     public function getParams($param = null,$return = null)
     {
         return $this->bootstrap->getParams($param,$return);
     }

     public function postParams($param = null,$return = null)
     {
         return $this->bootstrap->postParams($param,$return);
     }

     public function view($view,Array $dados = array())
     {
         extract($dados,EXTR_OVERWRITE);

         if(file_exists('../app/view/'.strtolower(get_called_class()).'/'.$view.'.phtml'))
             return include_once('../app/view/'.strtolower(get_called_class()).'/'.$view.'.phtml');
         die("View solicitada não existe.");
     }
}