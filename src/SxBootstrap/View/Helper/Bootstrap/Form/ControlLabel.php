<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;

class ControlLabel extends AbstractElementHelper
{

    /**
     * @param null $label
     * @param null $for
     * @param null $labelAttributes
     *
     * @return ControlLabel
     */
    public function __invoke($label = null, $for = null, $labelAttributes = null)
    {
        $this->setElement(new HtmlElement('label'));

        if (null !== $label) {
            $this->setLabel($label);
        }

        if (null !== $for) {
            $this->setFor($for);
        }

        if (is_array($labelAttributes)) {
            foreach ($labelAttributes as $key => $value) {
                $this->addAttribute($key, $value);
            }
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
