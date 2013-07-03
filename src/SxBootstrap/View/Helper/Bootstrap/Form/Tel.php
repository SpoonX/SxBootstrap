<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Tel extends Input
{
    /**
     * Renders telephone input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Tel
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('tel');
    }
}
