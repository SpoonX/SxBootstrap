<?php
/**
 * Badge
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\AbstractHelper;
use SxBootstrap\Exception;

/**
 * Badge
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Badge extends AbstractHelper
{

    /**
     * @var string
     */
     protected $format = '<span class="badge %s">%s</span>';

    /**
     * Display an Informational Badge
     *
     * @param   string  $badge
     * @return  string
     */
    public function info($badge)
    {
        return $this->render($badge, 'badge-info');
    }

    /**
     * Display an Important Badge
     *
     * @param   string  $badge
     * @return  string
     */
    public function important($badge)
    {
        return $this->render($badge, 'badge-important');
    }

    /**
     * Display an Inverse Badge
     *
     * @param   string  $badge
     * @return  string
     */
    public function inverse($badge)
    {
        return $this->render($badge, 'badge-inverse');
    }

    /**
     * Display a Sucess Badge
     *
     * @param   string  $badge
     *
     * @return  string
     */
    public function success($badge)
    {
        return $this->render($badge, 'badge-success');
    }

    /**
     * Display a Warning Badge
     *
     * @param   string  $badge
     *
     * @return  string
     */
    public function warning($badge)
    {
        return $this->render($badge, 'badge-warning');
    }

    /**
     * Render an Badge
     *
     * @param   string  $badge
     * @param   string  $class
     *
     * @return  string
     * @throws  Exception\InvalidArgumentException
     */
    public function render($badge, $class = '')
    {
        if (!is_string($badge)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Badge must be of type string, got "%s".',
                gettype($badge)
            ));
        }

        if (!is_string($class)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Provided class must be of type string, got "%s".',
                gettype($class)
            ));
        }

        return sprintf($this->format, trim($class, ' '), $badge);
    }

    /**
     * Invoke Badge
     *
     * @param   string  $badge
     * @param   string  $class
     *
     * @return  string|Badge
     */
    public function __invoke($badge = null, $class = '')
    {
        if ($badge) {
            return $this->render($badge, $class);
        }
        return $this;
    }
}
