<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Date extends Input
{
    /**
     * Renders Date input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Date
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('date');
    }

    /**
     * @param string $min Valid date string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Date
     */
    public function min($min)
    {
        $this->addAttribute('min', $min);

        return $this;
    }

    /**
     * @param string $max Valid date string
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Date
     */
    public function max($max)
    {
        $this->addAttribute('max', $max);

        return $this;
    }

    /**
     * @param int $step in days (default 1)
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Date
     */
    public function step($step)
    {
        $this->addAttribute('step', (string) $step);

        return $this;
    }
}
