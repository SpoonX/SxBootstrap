<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;

class Controls extends AbstractElementHelper
{

    /**
     * @param null|string|array $controls
     *
     * @return Controls
     */
    public function __invoke($controls = null)
    {
        $this->setElement(new HtmlElement);

        if (is_array($controls)) {
            $this->addControls($controls);
        } elseif (null !== $controls) {
            $this->addControl($controls);
        }

        $this->addClass('controls');

        return clone $this;
    }

    /**
     * @param string $control
     *
     * @return AbstractElementHelper
     */
    public function addControl($control)
    {
        return $this->getElement()->appendContent($control);
    }

    /**
     * @param array $controls
     *
     * @return Controls
     */
    public function addControls(array $controls)
    {
        foreach ($controls as $control) {
            $this->addControl($control);
        }

        return $this;
    }
}
