<?php
/**
 * Label
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\AbstractHelper;
use SxBootstrap\Exception;

/**
 * Label
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Label extends AbstractHelper
{

    /**
     * @var string
     */
     protected $format = '<span class="label %s">%s</span>';

    /**
     * Display an Informational Label
     *
     * @param   string  $label
     *
     * @return  string
     */
    public function info($label)
    {
        return $this->render($label, 'label-info');
    }

    /**
     * Display an Important Label
     *
     * @param   string  $label
     *
     * @return  string
     */
    public function important($label)
    {
        return $this->render($label, 'label-important');
    }

    /**
     * Display an Inverse Label
     *
     * @param   string  $label
     *
     * @return  string
     */
    public function inverse($label)
    {
        return $this->render($label, 'label-inverse');
    }

    /**
     * Display a Sucess Label
     *
     * @param   string  $label
     *
     * @return  string
     */
    public function success($label)
    {
        return $this->render($label, 'label-success');
    }

    /**
     * Display a Warning Label
     *
     * @param   string  $label
     *
     * @return  string
     */
    public function warning($label)
    {
        return $this->render($label, 'label-warning');
    }

    /**
     * Render an Label
     *
     * @param   string  $label
     * @param   string  $class
     *
     * @return  string
     * @throws  Exception\InvalidArgumentException
     */
    public function render($label, $class = '')
    {
        if (!is_string($label)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Label must be of type string, got "%s".',
                gettype($label)
            ));
        }

        if (!is_string($class)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Provided class must be of type string, got "%s".',
                gettype($class)
            ));
        }

        return sprintf($this->format, trim($class, ' '), $label);
    }

    /**
     * Invoke Label
     *
     * @param   string  $label
     * @param   string  $class
     *
     * @return  string|Label
     */
    public function __invoke($label = null, $class = '')
    {
        if ($label) {
            return $this->render($label, $class);
        }
        return $this;
    }
}
