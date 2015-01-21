<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 19:18
 */

  class Controller extends Aeskaeno {

     public function view($view = null,Array $dados = array())
     {
         if(null === $view)
         {
             $view = str_replace('_action', '', debug_backtrace()[1]['function']);
         }
         extract($dados,EXTR_OVERWRITE);

         if(file_exists('../app/view/'.strtolower(get_called_class()).'/'.$view.'.phtml'))
             return include_once('../app/view/'.strtolower(get_called_class()).'/'.$view.'.phtml');
         die("View solicitada não existe.");

     }
}