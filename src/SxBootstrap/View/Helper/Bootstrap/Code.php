<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;

/**
 * The ViewHelper that creates a block to represent Code.
 */
class Code extends AbstractElementHelper
{

    /**
     * Create a HTML Code element
     *
     * @param string $content The contents of the element
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Code Fluent interface
     */
    public function __invoke($content = '')
    {
        // Check if it is one line or multiple lines of code
        // We have to use the pre element when there are multiple lines of code.
        $isMultiLine = strpos($content, "\n") !== false;

        $this->setElement(new HtmlElement($isMultiLine ? 'pre' : 'code'));

        // Convert the content to valid (escaped) code
        $this->getElement()->setContent(htmlentities($content));

        return $this;
    }

    /**
     * Return the HTML string of this HTML element
     *
     * @return string
     */
    public function render()
    {
        return $this->getElement()->render();
    }

}
