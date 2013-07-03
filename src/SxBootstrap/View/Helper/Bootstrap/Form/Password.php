<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Password extends Input
{

    /**
     * Renders password input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Password
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('password');
    }
}
