<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Html\HtmlElement;
use Zend\Form\View\Helper\AbstractHelper;

/**
 * The ViewHelper that creates a block to represent a Well.
 */
abstract class AbstractElementHelper extends AbstractHelper
{

    /**
     * The html element to configure and render the element
     * @var \SxBootstrap\Html\HtmlElement
     */
    protected $element;

    /**
     * Renders a given ViewModel or passes the argument verbatim
     *
     * @param  string|\Zend\View\Model\ViewModel $content
     *
     * @return string
     */
    protected function maybeRender($content)
    {
        if ($content instanceof ViewModel) {
            $content = $this->getView()->render($content);
        }

        return $content;
    }

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
     * @return \SxBootstrap\Html\HtmlElement
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param \SxBootstrap\Html\HtmlElement $element
     *
     * @return AbstractElementHelper
     */
    public function setElement(HtmlElement $element)
    {
        $this->element = $element;

        return $this;
    }

}
