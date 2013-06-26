<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Radio extends Input
{
    /**
     * Renders Radio input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Radio
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('radio');
    }
}
