<?php

namespace aeskaeno\system\core;

use aeskaeno\system\core\Aeskaeno;
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 19:18
 */

  class Controller extends Aeskaeno {

     protected $layout = true;

     public function view($view = null,Array $dados = array())
     {
         if(null === $view)
         {
             $view = $this->getAction();
         }
         extract($dados,EXTR_OVERWRITE);
         
         if(file_exists('../aeskaeno/app/view/'.strtolower($this->getController()).'/'.$view.'.phtml')){
             $return = '';
             if($this->layout){
                 $return .= include_once('../aeskaeno/app/view/layout/header.phtml');

                 $return .= include_once('../aeskaeno/app/view/'.strtolower($this->getController()).'/'.$view.'.phtml');

                 $return .= include_once('../aeskaeno/app/view/layout/footer.phtml');
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
}