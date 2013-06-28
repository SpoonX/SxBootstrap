<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class DateTimeLocal extends Input
{
    /**
     * Renders Local Date and Time input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('datetime-local');
    }

    /**
     * @param string $min Valid local date and time string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal
     */
    public function min($min)
    {
        $this->addAttribute('min', $min);

        return $this;
    }

    /**
     * @param string $max Valid local date and time string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal
     */
    public function max($max)
    {
        $this->addAttribute('max', $max);

        return $this;
    }

    /**
     * @param int $step in seconds (default 60)
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal
     */
    public function step($step)
    {
        $this->addAttribute('step', (string) $step);

        return $this;
    }
}
