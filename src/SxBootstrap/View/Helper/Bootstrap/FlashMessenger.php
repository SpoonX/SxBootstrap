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

class FlashMessenger extends AbstractElementHelper
{
    /**
     * @var boolean $block displaymode
     */
    protected $isBlock = true;

    /**
     * The namespace messages to display
     *
     * @var string|null $namespaces
     */
    protected $namespaces = null;

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
     * Set the namespace that should be displayed
     *
     * @param string|array
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\FlashMessenger
     */
    public function setNamespaces($namespaces)
    {
        if (is_string($namespaces)) {
            $this->namespaces = array($namespaces);
        } elseif (is_array($namespaces)) {
            $this->namespaces = $namespaces;
        }

        return $this;
    }

    /**
     * Return the HTML string of this HTML element
     *
     * @return string
     */
    public function render()
    {
        $alerts = array();

        $namespaces = !is_null($this->namespaces) ? $this->namespaces : array_keys($this->namespaceClasses);

        foreach ($namespaces as $namespace) {
            if (is_object($alert = $this->getAlert($namespace))) {
                $alerts[] = $alert;
            }
        }

        return implode(' ', $alerts);
    }

    /**
     * @param   string|array|null   $namespace
     * @param   boolean             $isBlock
     *
     * @return  string
     */
    public function __invoke($namespace = null, $isBlock = true)
    {
        $this->block($isBlock);

        return clone $this;
    }

}
