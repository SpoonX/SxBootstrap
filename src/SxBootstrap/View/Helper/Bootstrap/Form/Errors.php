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
class Errors extends AbstractElementHelper
{

    /**
     * @param ElementInterface $element
     * @param bool             $block
     *
     * @return null|string
     */
    public function __invoke(ElementInterface $element = null, $block = false)
    {
        $messages = $element->getMessages();

        if (empty($messages)) {
            return null;
        }

        $errors = array();

        foreach ($messages as $message) {
            $error = new HtmlElement('span');

            $error->addClass($block ? 'help-block' : 'help-inline');
            $error->setContent($this->translate((string) $message));

            $errors[] = $error;
        }

        return implode(PHP_EOL, $errors);
    }
}
