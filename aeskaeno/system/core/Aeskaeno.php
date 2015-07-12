<?php

namespace Aeskaeno\System\Core;
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 23:39
 * Principal classe do sistema
 */

class Aeskaeno {

    protected $request;

    /**
     * metodo construtor
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * metodo de inicializacao do sistema
     */
    public function start()
    {
        $fullQualifiedClassName = "Aeskaeno\\App\\Controller\\" . ucfirst($this->request->getController()) . "Controller";
        $controler = new $fullQualifiedClassName();
        $controler->{$this->request->getAction(true)}();
    }

    public function getConfig($file)
    {
        return include dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . "aeskaeno/app/config/{$file}.php";
    }



}
