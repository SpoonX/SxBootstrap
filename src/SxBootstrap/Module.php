<?php
namespace SxBootstrap;

use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use SxBootstrap\Service\BootstrapLessFilter;
use SxBootstrap\Service\BootstrapLessphpFilter;
use SxBootstrap\Service\BootstrapResolver;

class Module implements AutoloaderProviderInterface, ServiceProviderInterface
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
                    if ($bootstrapConfig['use_lessphp'] === true) {
                        $BootstrapFilter = new BootstrapLessphpFilter($bootstrapConfig);
                    } else {
                        $BootstrapFilter = new BootstrapLessFilter($bootstrapConfig);
                    }
                    return $BootstrapFilter;
                },
                'SxBootstrap\Service\BootstrapResolver' => function($serviceManager) {
                    $config             = $serviceManager->get('Config');
                    $bootstrapConfig    = $config['twitter_bootstrap'];
                    $assetFilterManager = new BootstrapResolver($bootstrapConfig);

                    return $assetFilterManager;
                },
                'formElementErrors' => function ($serviceManager) {
                    $fee = new \Zend\Form\View\Helper\FormElementErrors();
                    $fee->setMessageCloseString('</li></ul>');
                    $fee->setMessageOpenFormat('<ul%s><li>');
                    $fee->setMessageSeparatorString('</li><li>');
                    $fee->setAttributes(array(
                        'class' => 'help-inline',
                    ));
                    return $fee;
                }
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
