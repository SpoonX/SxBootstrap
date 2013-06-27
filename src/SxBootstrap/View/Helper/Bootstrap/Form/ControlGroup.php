<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;

class ControlGroup extends AbstractElementHelper
{

    /**
     * @param null|string|array $control
     *
     * @return ControlGroup
     */
    public function __invoke($control = null)
    {
        $this->setElement(new HtmlElement);

        if (is_array($control)) {
            $this->addControls($control);
        }

        if (null !== $control) {
            $this->addControl($control);
        }

        $this->addClass('control-group');

        return clone $this;
    }

    /**4
     * @param string $control
     *
     * @return AbstractElementHelper
     */
    public function addControl($control)
    {
        return $this->setContent($this->getElement()->getContent() . $control);
    }

    /**
     * @param array $controls
     *
     * @return ControlGroup
     */
    public function addControls(array $controls)
    {
        foreach ($controls as $control) {
            $this->addControl($control);
        }

        return $this;
    }

    /**
     * @return ControlGroup
     */
    public function info()
    {
        return $this->addClass('info');
    }

    /**
     * @return ControlGroup
     */
    public function error()
    {
        return $this->addClass('error');
    }

    /**
     * @return ControlGroup
     */
    public function success()
    {
        return $this->addClass('success');
    }

    /**
     * @return ControlGroup
     */
    public function warning()
    {
        return $this->addClass('warning');
    }
}
