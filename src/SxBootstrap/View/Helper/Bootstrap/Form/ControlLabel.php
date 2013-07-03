<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;

class ControlLabel extends AbstractElementHelper
{

    /**
     * @param string $label
     * @param string $for
     *
     * @return ControlLabel
     */
    public function __invoke($label = null, $for = null)
    {
        $this->setElement(new HtmlElement('label'));

        if (null !== $label) {
            $this->setLabel($label);
        }

        if (null !== $for) {
            $this->setFor($for);
        }

        $this->addClass('control-label');

        return clone $this;
    }

    /**
     * @param string $for
     *
     * @return ControlLabel
     */
    public function setFor($for)
    {
        return $this->addAttribute('for', (string) $for);
    }

    /**
     * @param string $label
     *
     * @return ControlLabel
     */
    public function setLabel($label)
    {
        return $this->setContent($this->translate((string) $label));
    }
}
