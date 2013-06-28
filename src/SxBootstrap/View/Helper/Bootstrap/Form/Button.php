<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Button extends Input
{
    /**
     * Renders Button input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Button
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('button');
    }
}
