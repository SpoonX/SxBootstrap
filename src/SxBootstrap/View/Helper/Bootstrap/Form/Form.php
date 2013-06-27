<?php
/**
 * SxBootstrap
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxCore\Html\HtmlElement;
use SxBootstrap\Exception;
use Traversable;
use Zend\Form\Element;
use Zend\Form\ElementInterface;
use Zend\Form\Form as ZendForm;
use Zend\Form\Fieldset;
use Zend\Form\Element\Collection;
use Zend\Form\View\Helper\Form as FormHelper;
use Zend\View\Helper\AbstractHelper;
use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;

/**
 * Form Renderer
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Form extends AbstractElementHelper
{

    public function __invoke(ZendForm $form)
    {
        $form->prepare();
        $this->setElement(new HtmlElement('form'));
        $this->getElement()->setAttributes(array(
            'action' => '',
            'method' => 'get',
        ));

        if (!$form->hasAttribute('id')) {
            $form->setAttribute('id', $form->getName());
        }

        $this->getElement()->setAttributes($form->getAttributes());

        $this->setContent($this->renderElements($form->getIterator()));

        return clone $this;
    }

    public function renderElements(Traversable $elements)
    {
        /* @var $rowPlugin \SxBootstrap\View\Helper\Bootstrap\Form\Row */
        $elementPlugin = $this->getView()->plugin('sxb_form_row');

        foreach ($elements as $element) {
            if ($element instanceof ElementInterface) {
                $this->getElement()->addChild($elementPlugin($element)->getElement());
            } elseif ($element instanceof Fieldset) {
                $this->getElement()->addChild($this->renderFieldset($element));
            } else {
                throw new Exception\RuntimeException('New case!');
            }
        }

        return $this->getElement()->render();
    }

    /**
     * @param $content
     *
     * @return AbstractElementHelper
     */
    public function addContent($content)
    {
        return $this->setContent($this->getElement()->getContent() . $content);
    }

    protected function renderFieldset(Fieldset $fieldset)
    {
        $fieldsetElement = new HtmlElement('fieldset');
        $fieldsetElement->setContent($this->renderelements($fieldset));

        return $fieldsetElement;
    }
}
