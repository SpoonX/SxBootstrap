<?php
/**
 * SxBootstrap
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;

/**
 * Alert
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Alert extends AbstractElementHelper
{
     /**
      * @var boolean Enable/Disable the dismiss button
      */
     protected $closable = true;

    /**
     * Display an Informational Alert
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function info()
    {
        return $this->addClass('alert-info');
    }

    /**
     * Display an Error Alert
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function error()
    {
        return $this->addClass('alert-error');
    }

    /**
     * Display a Success Alert
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function success()
    {
        return $this->addClass('alert-success');
    }

    /**
     * Display a Warning Alert
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function warning()
    {
        return $this->addClass('alert-warning');
    }

    /**
     * Change the Alerts display type to block
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function block()
    {
        return $this->addClass('alert-block');
    }

    /**
     * Toggle the dismissbutton which makes it closable for the user.
     *
     * @param boolean $enabled
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function closable($enabled)
    {
        $this->closable = (bool)$enabled;

        return $this;
    }

    /**
     * Render an Alert
     *
     * @return  string
     */
    public function render()
    {
        if ($this->closable) {
            $this->createDismissButton();
        }

        $this->getElement()->setAppendContent();

        return $this->getElement()->render();
    }

    /**
     * Get the dismissal button
     *
     * @return \SxCore\Html\HtmlElement
     */
    protected function createDismissButton()
    {
        return $this->getElement()
            ->spawnChild('button')
            ->setContent('&times;')
            ->setAttributes(array(
                'data-dismiss'  => 'alert',
                'type'          => 'button'
            ))
            ->addClass('close');
    }

    /**
     * Invoke Alert
     * The isBlock parameter is used to convert the display type of the element to block.
     *
     * @param   string  $alert
     * @param   boolean $isBlock
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Alert
     */
    public function __invoke($alert = null, $isBlock = false)
    {
        $this->setElement(new HtmlElement);
        $this->addClass('alert');

        if ($isBlock) {
            $this->block();
        }

        if (!is_null($alert)) {
            $this->setContent($alert);
        }

        return clone $this;
    }
}
