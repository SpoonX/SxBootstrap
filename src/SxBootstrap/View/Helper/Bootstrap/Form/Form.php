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
     * All buttons, submit types etc to be rendered last.
     *
     * @var array
     */
    protected $formActionElements = array();

    /**
     * @param ZendForm $form
     * @param boolean  $groupActions
     *
     * @return Form
     */
    public function __invoke(ZendForm $form, $groupActions = false)
    {
        $this->formActionElements = array();

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
        $this->renderFormActions();

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
        $rowPlugin = $this->getRowPlugin();

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
                    $this->formActionElements[] = $element;

                    continue;
                }

                $this->getElement()->addChild($rowPlugin($element)->getElement());
            } else {
                throw new Exception\RuntimeException('Unexpected element.');
            }
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
        $parent          = $this->getElement();

        $fieldsetElement->addAttribute('id', $id);

        /**
         * This changes the scope of the current element,
         * so that the child elements (the ones that are about to be rendered),
         * will be set on the fieldset.
         * Then change it back again so that the fieldset will be added to the form.
         */
        $this
            ->setElement($fieldsetElement)
            ->renderElements($fieldset, $groupActions)
            ->setElement($parent);

        return $fieldsetElement;
    }

    /**
     * Render the form action elements, when needed.
     *
     * @return $this
     */
    protected function renderFormActions()
    {
        $rowPlugin = $this->getRowPlugin();

        if (!empty($this->formActionElements)) {
            $this->getElement()->addChild($rowPlugin($this->formActionElements, true)->getElement());
        }

        return $this;
    }

    /**
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Row
     */
    protected function getRowPlugin()
    {
        return $this->getView()->plugin('sxb_form_row');
    }
}
