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
     * @param bool     $groupActions
     *
     * @return Form
     */
    public function __invoke(ZendForm $form, $groupActions = false)
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
        $this->renderElements($form->getIterator(), $groupActions);

        return clone $this;
    }

    /**
     * @return AbstractElementHelper
     */
    public function horizontal()
    {
        return $this->addClass('form-horizontal');
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
        /* @var $elementPlugin \SxBootstrap\View\Helper\Bootstrap\Form\Row */
        /* @var $actionsPlugin \SxBootstrap\View\Helper\Bootstrap\Form\Actions */
        $rowPlugin      = $this->getView()->plugin('sxb_form_row');
        $actionElements = array();

        foreach ($elements as $element) {
            if ($element instanceof ElementInterface) {

                $type = $element->getAttribute('type');

                if ($groupActions && ($element instanceof Element\Submit || $element instanceof Element\Button || 'submit' === $type)) {
                    $actionElements[] = $element;

                    continue;
                }

                $this->getElement()->addChild($rowPlugin($element)->getElement());
            } elseif ($element instanceof Fieldset) {
                $this->getElement()->addChild($this->renderFieldset($element));
            } else {
                throw new Exception\RuntimeException('Unexpected element.');
            }
        }

        if (!empty($actionElements)) {
            $actionsPlugin = $this->getView()->plugin('sxb_form_actions');
            $actionsPlugin = $actionsPlugin();
            $elementPlugin = $this->getView()->plugin('sxb_form_element');

            foreach ($actionElements as $actionElement) {

                // Space to make sure buttons don't touch.
                $actionsPlugin->addContent($elementPlugin($actionElement) . ' ');
            }

            $this->getElement()->addChild($actionsPlugin->getElement());
        }

        return $this;
    }

    /**
     * @param Fieldset $fieldset
     * @param bool     $groupActions
     *
     * @return HtmlElement
     */
    protected function renderFieldset(Fieldset $fieldset, $groupActions = false)
    {
        $fieldsetElement = new HtmlElement('fieldset');
        $fieldsetElement->setContent($this->renderelements($fieldset, $groupActions));

        return $fieldsetElement;
    }
}
