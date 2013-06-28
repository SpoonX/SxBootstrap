<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Reset extends Input
{
    /**
     * Renders Reset Button input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Reset
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('reset');
    }
}
