<?php
/**
 * SxBootstrap
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\View\Helper\AbstractHelper;
use SxBootstrap\Exception;

/**
 * Alert
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Alert extends AbstractHelper
{

    /**
     * @var string The format of the alert
     */
     protected $format = '<div class="alert %s">%s%s</div>';

     /**
      * @var string The markup of the dismiss button
      */
     protected $dismissHtml = '<button type="button" class="close" data-dismiss="alert">&times;</button>';

    /**
     * Display an Informational Alert
     *
     * @param   string  $alert
     * @param   boolean $isBlock
     *
     * @return  string
     */
    public function info($alert, $isBlock = false)
    {
        return $this->render($alert, $isBlock, 'alert-info');
    }

    /**
     * Display an Error Alert
     *
     * @param   string  $alert
     * @param   boolean $isBlock
     *
     * @return  string
     */
    public function error($alert, $isBlock = false)
    {
        return $this->render($alert, $isBlock, 'alert-error');
    }

    /**
     * Display a Success Alert
     *
     * @param   string  $alert
     * @param   boolean $isBlock
     *
     * @return string
     */
    public function success($alert, $isBlock = false)
    {
        return $this->render($alert, $isBlock, 'alert-success');
    }

    /**
     * Display a Warning Alert
     *
     * @param   string  $alert
     * @param   boolean $isBlock
     *
     * @return string
     */
    public function warning($alert, $isBlock = false)
    {
        return $this->render($alert, $isBlock);
    }

    /**
     * Render an Alert
     *
     * @param   string  $alert
     * @param   boolean $isBlock
     * @param   string  $class
     *
     * @return  string
     * @throws  Exception\InvalidArgumentException
     */
    public function render($alert, $isBlock = false, $class = '')
    {
        if (!is_string($alert)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Alert must be of type string, got "%s".',
                gettype($alert)
            ));
        }

        if (!is_string($class)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Provided class must be of type string, got "%s".',
                gettype($class)
            ));
        }

        if (true === $isBlock) {
            $class .= ' alert-block';
        }

        return sprintf(
            $this->format,
            trim($class, ' '),
            $this->dismissHtml,
            $alert
        );
    }

    /**
     * Invoke Alert
     *
     * @param   string  $alert
     * @param   boolean $isBlock
     * @param   string  $class
     *
     * @return  string|Alert
     */
    public function __invoke($alert = null, $isBlock = false, $class = '')
    {
        if (null !== $alert) {
            return $this->render($alert, $isBlock, $class);
        }

        return $this;
    }
}
