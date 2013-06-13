<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;
use Zend\Form\View\Helper\AbstractHelper;

/**
 * The ViewHelper that creates a block to represent a Well.
 */
abstract class AbstractElementHelper extends AbstractHelper
{

    /**
     * The html element to configure and render the element
     * @var \SxCore\Html\HtmlElement
     */
    protected $element;

    /**
     * Add a class to the element
     *
     * @param   string  $class  name of the class
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper
     */
    public final function addClass($class)
    {
        // Set the class on the element
        $this->element->addClass($class);

        return $this;
    }

    /**
     * Add attribute on element
     *
     * @param   string  $key
     * @param   string  $value
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper
     */
    public function addAttribute($key, $value)
    {
        $this->element->addAttribute($key, $value);

        return $this;
    }

    /**
     * Set the content of the element
     *
     * @param   string $content
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper
     */
    public function setContent($content)
    {
        $this->element->setContent($content);

        return $this;
    }

    /**
     * Return the HTML string of this HTML element
     *
     * @return string
     */
    public abstract function render();

    /**
     * Return the markup string of the Code block
     *
     * @return string
     */
    public final function __toString()
    {
        return (string)$this->render();
    }

    /**
     * @return \SxCore\Html\HtmlElement
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param \SxCore\Html\HtmlElement $element
     *
     * @return AbstractElementHelper
     */
    public function setElement(HtmlElement $element)
    {
        $this->element = $element;

        return $this;
    }

}
