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
use SxBootstrap\Exception;

class FlashMessenger extends AbstractElementHelper
{
    /**
     * @var boolean $block display-mode
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
    protected $availableNamespaces = array(
        PluginFlashMessenger::NAMESPACE_INFO,
        PluginFlashMessenger::NAMESPACE_DEFAULT,
        PluginFlashMessenger::NAMESPACE_SUCCESS,
        PluginFlashMessenger::NAMESPACE_WARNING,
        PluginFlashMessenger::NAMESPACE_ERROR,
    );

    /**
     * Get the Alert objects containing the messages that are registered on the flash messenger.
     *
     * @param string $namespace the messages by namespace
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function getAlert($namespace)
    {

        $messagesToPrint = $this->getView()->plugin('flash_messenger')->render($namespace);

        if (empty($messagesToPrint)) {
            return null;
        }

        $alert = $this->getView()->plugin('sxb_alert')->__invoke($messagesToPrint);

        if (in_array($namespace, $this->availableNamespaces)) {

            if (PluginFlashMessenger::NAMESPACE_DEFAULT === $namespace) {
                $namespace = PluginFlashMessenger::NAMESPACE_INFO;
            }

            $alert->$namespace();
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
     * @param mixed $namespaces
     *
     * @throws \SxBootstrap\Exception\InvalidArgumentException
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\FlashMessenger
     */
    public function setNamespaces($namespaces)
    {
        if (is_string($namespaces)) {
            $this->namespaces = array($namespaces);
        } elseif (is_array($namespaces)) {
            $this->namespaces = $namespaces;
        } else {
            throw new Exception\InvalidArgumentException(
                "Invalid argument, expected a string or array. Got ".gettype($namespaces)."."
            );
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
        $alerts     = array();
        $namespaces = !is_null($this->namespaces) ? $this->namespaces : $this->availableNamespaces;

        foreach ($namespaces as $namespace) {
            $alert = $this->getAlert($namespace);

            if (is_object($alert)) {
                $alerts[] = $alert;
            }
        }

        return implode($alerts);
    }

    /**
     * @param string|array|null $namespace
     * @param boolean           $isBlock
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\FlashMessenger
     */
    public function __invoke($namespace = null, $isBlock = true)
    {
        $this->namespaces = null;

        if (!is_null($namespace)) {
            $this->setNamespaces($namespace);
        }

        $this->block($isBlock);

        return clone $this;
    }

    /**
     * @return bool
     */
    public function hasMessages()
    {
        $namespaces = !is_null($this->namespaces) ? $this->namespaces : $this->availableNamespaces;

        foreach ($namespaces as $namespace) {
            if (0 < count($this->getView()->plugin('flash_messenger')->__invoke($namespace))) {
                return true;
            }
        }

        return false;
    }
}
