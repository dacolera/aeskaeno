<?php

namespace aeskaeno\system\factories;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use aeskaeno\system\core\Aeskaeno;

class CoreFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Aeskaeno();
    }
}