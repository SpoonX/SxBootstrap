<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Image extends Input
{
    /**
     * Renders Image Button input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Image
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('image');
    }

    /**
     * @param string $alt
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Image
     */
    public function alt($alt)
    {
        $this->addAttribute('alt', $alt);

        return $this;
    }

    /**
     * @param string $src
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Image
     */
    public function src($src)
    {
        $this->addAttribute('src', $src);

        return $this;
    }

    /**
     * @param int $width
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Image
     */
    public function width($width)
    {
        $this->addAttribute('width', (string) $width);

        return $this;
    }

    /**
     * @param int $height
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Image
     */
    public function height($height)
    {
        $this->addAttribute('height', (string) $height);

        return $this;
    }
}
