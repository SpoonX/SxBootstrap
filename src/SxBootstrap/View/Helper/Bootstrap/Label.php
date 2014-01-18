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
     * @var string
     */
    protected $labelType = 'label-default';

    /**
     * @param $labelType
     *
     * @return $this
     */
    protected function setLabelType($labelType)
    {
        $this->labelType = $labelType;
        return $this;
    }

    /**
     * @return string
     */
    protected function getLabelType()
    {
        return $this->labelType;
    }

    /**
     * Display a Primary Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function primary()
    {
        return $this->setLabelType('label-primary');
    }

    /**
     * Display an Informational Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function info()
    {
        return $this->setLabelType('label-info');
    }

    /**
     * Display a Danger Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function danger()
    {
        return $this->setLabelType('label-danger');
    }

    /**
     * Display a Success Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function success()
    {
        return $this->setLabelType('label-success');
    }

    /**
     * Display a Warning Label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function warning()
    {
        return $this->setLabelType('label-warning');
    }

    /**
     * @param string $label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function setLabel($label)
    {
        return $this->setContent($this->translate((string) $label));
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
            $this->setLabel($label);
        }

        $this->addClass('label');

        return clone $this;
    }

    /**
     * Render the label depending of its type
     *
     * @return string
     */
    public function render()
    {
        $this->addClass($this->getLabelType());
        return parent::render();
    }
}
