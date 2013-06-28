<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;

class ControlGroup extends AbstractElementHelper
{

    /**
     * @param null|string $control
     *
     * @return ControlGroup
     */
    public function __invoke($control = null)
    {
        $this->setElement(new HtmlElement);

        if (is_array($control)) {
            $this->addContents($control);
        } elseif (null !== $control) {
            $this->addContent($control);
        }

        $this->addClass('control-group');

        return clone $this;
    }

    /**
     * @param string $control
     *
     * @return ControlGroup
     */
    public function addContent($control)
    {
        return $this->getElement()->appendContent($control);
    }

    /**
     * @param array $controls
     *
     * @return ControlGroup
     */
    public function addContents(array $controls)
    {
        foreach ($controls as $control) {
            $this->addContent($control);
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
