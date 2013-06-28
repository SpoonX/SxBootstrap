<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Hidden extends Input
{
    /**
     * Renders hidden input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Hidden
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('hidden');
    }
}
