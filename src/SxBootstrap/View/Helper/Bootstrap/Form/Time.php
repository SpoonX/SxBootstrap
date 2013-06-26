<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Time extends Input
{
    /**
     * Renders Time input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Time
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('time');
    }

    /**
     * @param string $min Valid time string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Time
     */
    public function min($min)
    {
        $this->addAttribute('min', $min);

        return $this;
    }

    /**
     * @param string $max Valid time string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Time
     */
    public function max($max)
    {
        $this->addAttribute('max', $max);

        return $this;
    }

    /**
     * @param int $step in seconds (default 60)
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Time
     */
    public function step($step)
    {
        $this->addAttribute('step', (string) $step);

        return $this;
    }
}
