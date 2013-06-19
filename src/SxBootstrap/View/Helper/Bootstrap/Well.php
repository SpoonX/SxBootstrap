<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;

/**
 * The ViewHelper that creates a block to represent a Well.
 */
class Well extends AbstractElementHelper
{

    /**
     * Create a HTML Code element
     *
     * @param string $content The contents of the element
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Code
     */
    public function __invoke($content = '')
    {
        // Create the HtmlElement and consider the tag to use
        $this->setElement(new HtmlElement);

        // Add the well class to the element
        $this->getElement()->addClass('well');

        // Convert the content to valid html.
        $this->getElement()->setContent($content);

        return clone $this;
    }

    /**
     * Use the small well.
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Well
     */
    public function small()
    {
        $this->addClass('well-small');

        return $this;
    }

    /**
     * Use the large well.
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Well
     */
    public function large()
    {
        $this->addClass('well-large');

        return $this;
    }

}
