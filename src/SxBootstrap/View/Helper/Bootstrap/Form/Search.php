<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Search extends Input
{
    /**
     * Renders Search input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Search
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('search');
    }
}
