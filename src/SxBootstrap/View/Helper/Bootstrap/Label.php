<?php
/**
 * Label
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;

/**
 * Label
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Label extends AbstractElementHelper
{
    /**
     * Display an Informational Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function info()
    {
        return $this->addClass('label-info');
    }

    /**
     * Display an Important Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function important()
    {
        return $this->addClass('label-important');
    }

    /**
     * Display an Inverse Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function inverse()
    {
        return $this->addClass('label-inverse');
    }

    /**
     * Display a Success Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function success()
    {
        return $this->addClass('label-success');
    }

    /**
     * Display a Warning Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function warning()
    {
        return $this->addClass('label-warning');
    }

    /**
     * Invoke Label
     *
     * @param string $label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function __invoke($label = null)
    {
        $this->setElement(new HtmlElement('span'));

        if (!is_null($label)) {
            $this->setContent($label);
        }

        $this->addClass('label');

        return clone $this;
    }
}
