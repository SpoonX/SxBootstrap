<?php
namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Html\HtmlElement;
use Zend\Form\View\Helper\AbstractHelper as ZendAbstractHelper;

/**
 * 	The ViewHelper that creates a block to represent a Well.
 */
abstract class AbstractHelper extends ZendAbstractHelper
{
	/**
	 * 	The html element to configure and render the element
	 * 	@var SxBootstrap\Html\HtmlElement
	 */
    protected $element;

    /**
     *  Add a class to the element
     *  @param string name of the class
     *  @return SxBootstrap\View\Helper\Bootstrap\AbstractHelper
     */
    public final function addClass($class)
    {
        // Set the class on the element
        $this->element->addClass($class);

        // return ourself
        return $this;
    }

    /**
     *  Return the HTML string of this HTML element
     *  @return string
     */
    public abstract function render();

    /**
     *  Return the string representive of the Code block
     *  @return string
     */
    public final function __toString()
    {
        return $this->render();
    }
}
