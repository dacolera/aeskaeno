<?php

namespace Aeskaeno\System\Factories;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Aeskaeno\System\Core\Aeskaeno;

class CoreFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Aeskaeno();
    }
}