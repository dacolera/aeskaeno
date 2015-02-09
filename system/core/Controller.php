<?php
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
             $view = str_replace('_action', '', debug_backtrace()[1]['function']);
         }
         extract($dados,EXTR_OVERWRITE);

         if(file_exists('../app/view/'.strtolower(get_called_class()).'/'.$view.'.phtml')){
             $return = '';
             if($this->layout){
                 $return .= include_once('../app/view/layout/header.phtml');

                 $return .= include_once('../app/view/'.strtolower(get_called_class()).'/'.$view.'.phtml');

                 $return .= include_once('../app/view/layout/footer.phtml');
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