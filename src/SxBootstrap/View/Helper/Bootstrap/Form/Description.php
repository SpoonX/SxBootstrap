<?php
/**
 * SxBootstrap
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage View
 */

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;
use Zend\Form\ElementInterface;

/**
 * Form Description
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage View
 */
class Description extends AbstractElementHelper
{

    /**
     * @param ElementInterface $element
     * @param boolean          $block
     *
     * @return string
     */
    public function __invoke(ElementInterface $element, $block = false)
    {
        $this->setElement(new HtmlElement('p'));

        $message = null;
        $message = $element->getOption('description');

        if (null === $message) {
            return '';
        }

        $this->addClass('help-block');
        $this->setDescription($message);

        return $this->render();
    }

    /**
     * @param string $description
     *
     * @return Description
     */
    protected function setDescription($description)
    {
        return $this->setContent($this->translate((string) $description));
    }
}
