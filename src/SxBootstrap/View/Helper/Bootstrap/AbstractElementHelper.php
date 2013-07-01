<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;
use Zend\I18n\View\Helper\AbstractTranslatorHelper;

/**
 * The ViewHelper that creates a block to represent a Well.
 */
abstract class AbstractElementHelper extends AbstractTranslatorHelper
{

    /**
     * The html element to configure and render the element
     * @var \SxCore\Html\HtmlElement
     */
    protected $element;

    /**
     * Add a class to the element
     *
     * @param string $class name of the class
     *
     * @return $this
     */
    final public function addClass($class)
    {
        // Set the class on the element
        $this->element->addClass($class);

        return $this;
    }

    /**
     * Translate a string.
     *
     * @param $string
     *
     * @return string
     */
    protected function translate($string)
    {
        if ($this->hasTranslator()) {
            return $this->getTranslator()->translate($string, $this->getTranslatorTextDomain());
        }

        return $string;
    }

    /**
     * Add attribute on element
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function addAttribute($key, $value = null)
    {
        $this->element->addAttribute($key, $value);

        return $this;
    }

    /**
     * Set the content of the element
     *
     * @param string $content
     *
     * @return $this
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
    public function render()
    {
        return $this->getElement()->render();
    }

    /**
     * Return the markup string of the Code block
     *
     * @return string
     */
    final public function __toString()
    {
        return (string) $this->render();
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
     * @return $this
     */
    public function setElement(HtmlElement $element)
    {
        $this->element = $element;

        return $this;
    }

}
