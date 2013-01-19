<?php
namespace SxBootstrap;

use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use SxBootstrap\Service\BootstrapFilter;
use SxBootstrap\Service\BootstrapResolver;

class Module implements AutoloaderProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'SxBootstrap\Service\BootstrapFilter' => function($serviceManager) {
                    $config          = $serviceManager->get('Config');
                    $bootstrapConfig = $config['twitter_bootstrap'];
                    $BootstrapFilter = new BootstrapFilter($bootstrapConfig);

                    return $BootstrapFilter;
                },
                'SxBootstrap\Service\BootstrapResolver' => function($serviceManager) {
                    $config             = $serviceManager->get('Config');
                    $bootstrapConfig    = $config['twitter_bootstrap'];
                    $assetFilterManager = new BootstrapResolver($bootstrapConfig);

                    return $assetFilterManager;
                },
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
