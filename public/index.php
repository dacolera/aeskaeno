<?php

    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);


    require "../vendor/autoload.php";

    use Zend\ServiceManager\ServiceManager;

    $serviceManager = new ServiceManager();
    $serviceManager->setFactory('bootstrap', '\aeskaeno\system\factories\CoreFactory');

    $bootstrap = $serviceManager->get('bootstrap');

    $bootstrap->start();

