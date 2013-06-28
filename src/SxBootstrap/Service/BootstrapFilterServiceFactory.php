<?php

namespace SxBootstrap\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BootstrapFilterServiceFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     *
     * @return BootstrapFilter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new BootstrapFilter($serviceLocator->get('SxBootstrap\Options\ModuleOptions'));
    }
}
