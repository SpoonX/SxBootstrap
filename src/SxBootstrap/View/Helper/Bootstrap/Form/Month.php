<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Month extends Input
{
    /**
     * Renders Month input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Month
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('month');
    }

    /**
     * @param string $min Valid month string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Month
     */
    public function min($min)
    {
        $this->addAttribute('min', $min);

        return $this;
    }

    /**
     * @param string $max Valid month string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Month
     */
    public function max($max)
    {
        $this->addAttribute('max', $max);

        return $this;
    }

    /**
     * @param int $step in months (default 1)
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Month
     */
    public function step($step)
    {
        $this->addAttribute('step', (string) $step);

        return $this;
    }
}
