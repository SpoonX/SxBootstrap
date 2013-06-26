<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class File extends Input
{
    /**
     * Renders File input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\File
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('file');
    }

    /**
     * @param array|string $accept File type hint, e.g. image/*
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\File
     */
    public function accept($accept)
    {
        if (is_array($accept)) {
            $accept = explode(',', $accept);
        }

        $this->addAttribute('accept', $accept);

        return $this;
    }

    /**
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\File
     */
    public function multiple($name)
    {
        $this->addAttribute('multiple', '');

        return $this;
    }
}
