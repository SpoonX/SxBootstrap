<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Color extends Input
{
    /**
     * Renders Color input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Color
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('color');
    }
}
