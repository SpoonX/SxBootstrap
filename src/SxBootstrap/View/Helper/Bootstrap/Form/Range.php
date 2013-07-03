<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Range extends Input
{
    /**
     * Renders Range input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Range
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('range');
    }

    /**
     * @param integer|string $min
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Range
     */
    public function min($min)
    {
        $this->addAttribute('min', (string) $min);

        return $this;
    }

    /**
     * @param integer|string $max
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Range
     */
    public function max($max)
    {
        $this->addAttribute('max', (string) $max);

        return $this;
    }

    /**
     * @param integer|string $step
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Range
     */
    public function step($step)
    {
        $this->addAttribute('step', (string) $step);

        return $this;
    }
}
