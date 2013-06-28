<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use Zend\Form\ElementInterface;

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

    /**
     * {@InheritDoc}
     */
    protected function initFormElement(ElementInterface $element)
    {
        $value = $element->getValue();

        if (!empty($value)) {
            $this->addAttribute('value', $this->translate($value));
        }

        return parent::initFormElement($element);
    }
}
