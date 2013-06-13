<?php
/**
 * Badge
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Exception;
use SxCore\Html\HtmlElement;

/**
 * Badge
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Badge extends AbstractElementHelper
{
    /**
     * Display an Informational Badge
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Badge
     */
    public function info()
    {
        return $this->addClass('badge-info');
    }

    /**
     * Display an Important Badge
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Badge
     */
    public function important()
    {
        return $this->addClass('badge-important');
    }

    /**
     * Display an Inverse Badge
     *
     * @param   string  $badge
     * @return \SxBootstrap\View\Helper\Bootstrap\Badge
     */
    public function inverse()
    {
        return $this->addClass('badge-inverse');
    }

    /**
     * Display a Sucess Badge
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Badge
     */
    public function success()
    {
        return $this->addClass('badge-success');
    }

    /**
     * Display a Warning Badge
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Badge
     */
    public function warning()
    {
        return $this->addClass('badge-warning');
    }

    /**
     * Render an Badge
     *
     * @return  string
     */
    public function render()
    {
        return $this->getElement()->render();
    }

    /**
     * Invoke Badge
     *
     * @param   string  $badge
     *
     * @return  Badge
     * @throws  Exception\InvalidArgumentException
     */
    public function __invoke($badge)
    {
        if (!is_string($badge)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Badge must be of type string, got "%s".',
                gettype($badge)
            ));
        }

        $this->setElement(new HtmlElement('span'))->addClass('badge');

        return clone $this->setContent($badge);
    }
}
