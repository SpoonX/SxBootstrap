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
     * @var boolean $block displaymode
     */
    protected $isBlock = true;

    /**
     * @var array Array of classes used for namespaces
     */
    protected $namespaceClasses = array(
        PluginFlashMessenger::NAMESPACE_INFO    => 'info',
        PluginFlashMessenger::NAMESPACE_DEFAULT => 'info',
        PluginFlashMessenger::NAMESPACE_SUCCESS => 'success',
        PluginFlashMessenger::NAMESPACE_WARNING => 'warning',
        PluginFlashMessenger::NAMESPACE_ERROR   => 'error',
    );

    /**
     * Get the Alert objects containing the messages that are registered on the flash messenger.
     *
     * @param string $namespace the messages by namespace
     *
     * @return Alert
     */
    public function getAlert($namespace)
    {
        $messagesToPrint = $this->getView()->plugin('flash_messenger')->render($namespace);

        if (empty($messagesToPrint)) {
            return null;
        }

        $alert = $this->getView()->plugin('sxb_alert')->__invoke($messagesToPrint);

        if (isset($this->namespaceClasses[$namespace])) {
            $alert->{$this->namespaceClasses[$namespace]}();
        }

        if ($this->isBlock) {
            $alert->block();
        }

        return $alert;
    }

    /**
     * Toggle the display mode for each alert to block.
     *
     * @param boolean $enabled
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\FlashMessenger
     */
    public function block($enabled = null)
    {
        if (is_null($enabled)) {
            $enabled = !$this->isBlock;
        }

        $this->isBlock = $enabled;

        return $this;
    }

    /**
     * @param   string|array|null   $namespace
     * @param   boolean             $isBlock
     *
     * @return  string
     */
    public function __invoke($namespace = null, $isBlock = true)
    {
        $alerts = array();

        $this->block($isBlock);

        if (is_string($namespace)) {
            $namespaces = array($namespace);
        } elseif (is_array($namespace)) {
            $namespaces = $namespace;
        } else {
            $namespaces = array_keys($this->namespaceClasses);
        }

        foreach ($namespaces as $namespace) {
            if (is_object($alert = $this->getAlert($namespace))) {
                $alerts[] = $alert;
            }
        }

        return implode(' ', $alerts);
    }

}
