<?php

    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);


    $config = include_once("../app/config/config.php");
    require_once('../system/core/Configuration.php');
    require_once('../system/core/Aeskaeno.php');
    require_once('../system/core/Controller.php');
    require_once('../system/core/Model.php');


    function __autoload($class)
    {
       if(file_exists('../app/model/'.$class.'.php'))
       {
           require_once('../app/model/'.$class.'.php');
       }
       elseif(file_exists('../system/helpers/'.$class.'_helper.php'))
       {
           require_once('../system/helpers/'.$class.'_helper.php');
       }
       else
           die('Classe solicitada não encontrada');
    }

    $bootstrap = new Aeskaeno();
    print "<pre>";
    print_r($bootstrap->parameters); exit;
    $bootstrap->start();

