<?php

namespace SxBootstrap\Options;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{

    /**
     * {@inheritDoc}
     *
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config          = $serviceLocator->get('Config');
        $bootstrapConfig = !empty($config['twitter_bootstrap']) ? $config['twitter_bootstrap'] : array();

        return new ModuleOptions($bootstrapConfig);
    }
}
