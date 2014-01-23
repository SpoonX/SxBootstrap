<?php
/**
 * Created by EBelair.
 * User: manu
 * Date: 23/01/14
 * Time: 22:23
 */

namespace SxBootstrap\View\Helper\Bootstrap\Form;


use Zend\Form\ElementInterface;

class Radio extends MultiCheckbox
{
    /**
     * Return input type
     *
     * @return string
     */
    protected function getInputType()
    {
        return 'radio';
    }

    /**
     * Get element name
     *
     * @param  ElementInterface $element
     * @return string
     */
    protected static function getName(ElementInterface $element)
    {
        return $element->getName();
    }
}
