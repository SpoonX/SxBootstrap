<?php

/**
 * SxBootstrap
 *
 * @category SxBootstrap
 * @package SxBootstrap_View
 * @subpackage Helper
 *
 * @method \SxBootstrap\Controller\Plugin\FlashMessenger getPluginFlashMessenger()
 */

namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Controller\Plugin\FlashMessenger as PluginFlashMessenger;
use Zend\View\Helper\AbstractHelper;

class FlashMessenger extends AbstractHelper
{

    /**
     * @var array Array of classes used for namespaces
     */
    protected $namespaceClasses = array(
        PluginFlashMessenger::NAMESPACE_INFO    => 'alert alert-info',
        PluginFlashMessenger::NAMESPACE_DEFAULT => 'alert alert-info',
        PluginFlashMessenger::NAMESPACE_SUCCESS => 'alert alert-success',
        PluginFlashMessenger::NAMESPACE_WARNING => 'alert alert-warning',
        PluginFlashMessenger::NAMESPACE_ERROR   => 'alert alert-error',
    );

    /**
     * @param   string|null $namespace
     * @param   boolean     $isBlock
     *
     * @return  string
     */
    public function __invoke($namespace = null, $isBlock = false)
    {
        if (!empty($namespace)) {
            $messagesToPrint = $this->getView()->plugin('flash_messenger')->render($namespace);

            if (empty($messagesToPrint)) {
                return '';
            }

            $class = '';

            if (isset($this->namespaceClasses[$namespace])) {
                $class = $this->namespaceClasses[$namespace];
            }

            return $this->getView()->plugin('sxb_alert')->__invoke($messagesToPrint, $isBlock, $class);
        }

        $message = '';

        foreach ($this->namespaceClasses as $namespace => $class) {
            $messagesToPrint = $this->getView()->plugin('flash_messenger')->render($namespace);

            if (empty($messagesToPrint)) {
                continue;
            }

            if (isset($this->namespaceClasses[$namespace])) {
                $class = $this->namespaceClasses[$namespace];
            }

            $message .= $this->getView()->plugin('sxb_alert')->__invoke($messagesToPrint, $isBlock, $class);
        }

        return $message;
    }

}
