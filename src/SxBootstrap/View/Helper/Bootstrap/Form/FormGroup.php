<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;

class FormGroup extends AbstractElementHelper
{

    /**
     * @param null|string $control
     *
     * @return FormGroup
     */
    public function __invoke($control = null)
    {
        $this->setElement(new HtmlElement);

        if (is_array($control)) {
            $this->addContents($control);
        } elseif (null !== $control) {
            $this->addContent($control);
        }

        $this->addClass('form-group');

        return clone $this;
    }

    /**
     * @param string $control
     *
     * @return FormGroup
     */
    public function addContent($control)
    {
        return $this->getElement()->appendContent($control);
    }

    /**
     * @param array $controls
     *
     * @return FormGroup
     */
    public function addContents(array $controls)
    {
        foreach ($controls as $control) {
            $this->addContent($control);
        }

        return $this;
    }

    /**
     * @return FormGroup
     */
    public function info()
    {
        return $this->addClass('info');
    }

    /**
     * @return FormGroup
     */
    public function error()
    {
        return $this->addClass('error');
    }

    /**
     * @return FormGroup
     */
    public function success()
    {
        return $this->addClass('success');
    }

    /**
     * @return FormGroup
     */
    public function warning()
    {
        return $this->addClass('warning');
    }
}
