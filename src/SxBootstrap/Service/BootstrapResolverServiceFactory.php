<?php

namespace SxBootstrap\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BootstrapResolverServiceFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     *
     * @return BootstrapResolver
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new BootstrapResolver($serviceLocator->get('SxBootstrap\Options\ModuleOptions'));
    }
}
