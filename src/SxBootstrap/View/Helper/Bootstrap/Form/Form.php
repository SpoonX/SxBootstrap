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
    /**
     * @param ZendForm $form
     * @param boolean  $groupActions
     *
     * @return Form
     */
    public function __invoke(ZendForm $form, $groupActions = false)
    {
        $form->prepare();
        $this->setElement(new HtmlElement('form'));
        $this->getElement()->setAttributes(array(
            'action' => '',
            'method' => 'GET',
        ));

        if (!$form->hasAttribute('id')) {
            $form->setAttribute('id', $form->getName());
        }

        $this->getElement()->addAttributes($form->getAttributes());
        $this->renderElements($form->getIterator(), $groupActions);

        return clone $this;
    }

    /**
     * @param Traversable $elements
     * @param boolean     $groupActions
     *
     * @return $this
     * @throws \SxBootstrap\Exception\RuntimeException
     */
    public function renderElements(Traversable $elements, $groupActions = false)
    {
        /* @var $rowPlugin     \SxBootstrap\View\Helper\Bootstrap\Form\Row */
        /* @var $actionsPlugin \SxBootstrap\View\Helper\Bootstrap\Form\Actions */
        $rowPlugin      = $this->getView()->plugin('sxb_form_row');
        $actionElements = array();

        foreach ($elements as $element) {
            if ($element instanceof Fieldset) {
                $this->getElement()->addChild($this->renderFieldset($element, $groupActions));
            } elseif ($element instanceof ElementInterface) {

                $type = $element->getAttribute('type');

                $conditions = array(
                    $element instanceof Element\Submit,
                    $element instanceof Element\Button,
                    'submit' === $type,
                    'reset' === $type,
                );

                if ($groupActions && (in_array(true, $conditions))) {
                    $actionElements[] = $element;

                    continue;
                }

                $this->getElement()->addChild($rowPlugin($element)->getElement());
            } else {
                throw new Exception\RuntimeException('Unexpected element.');
            }
        }

        if (!empty($actionElements)) {
            $this->getElement()->addChild($rowPlugin($actionElements, true)->getElement());
        }

        return $this;
    }

    /**
     * @return AbstractElementHelper
     */
    public function horizontal()
    {
        return $this->addClass('form-horizontal');
    }

    /**
     * @param Fieldset $fieldset
     * @param boolean  $groupActions
     *
     * @return HtmlElement
     */
    protected function renderFieldset(Fieldset $fieldset, $groupActions = false)
    {
        $fieldsetElement = new HtmlElement('fieldset');
        $id              = $fieldset->getAttribute('id') ? : $fieldset->getName();

        $fieldsetElement->addAttribute('id', $id);
        $fieldsetElement->setContent($this->renderelements($fieldset, $groupActions));

        return $fieldsetElement;
    }
}
