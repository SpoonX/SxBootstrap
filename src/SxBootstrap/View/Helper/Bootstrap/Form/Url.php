<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Url extends Input
{
    /**
     * Renders URL input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Url
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('url');
    }
}
