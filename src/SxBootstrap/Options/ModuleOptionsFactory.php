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
        $bootstrapConfig = $config['twitter_bootstrap'];
        $moduleOptions   = new ModuleOptions($bootstrapConfig);

        return $moduleOptions;
    }
}
