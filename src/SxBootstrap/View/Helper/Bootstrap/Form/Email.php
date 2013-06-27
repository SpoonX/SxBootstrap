<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Email extends Input
{
    /**
     * Renders E-mail input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Email
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('email');
    }

    /**
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Email
     */
    public function multiple()
    {
        $this->addAttribute('multiple', '');

        return $this;
    }
}
