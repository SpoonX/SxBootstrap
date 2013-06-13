<?php
/**
 * SxBootstrap
 *
 * @category SxBootstrap
 * @package SxBootstrap_View
 * @subpackage Helper
 */

namespace SxBootstrap\View\Helper\Bootstrap;

use Traversable;
use Zend\Form\ElementInterface;
use Zend\Form\Form as ZendForm;
use Zend\Form\Fieldset;
use Zend\Form\Element\Collection;
use Zend\Form\View\Helper\Form as FormHelper;
use Zend\View\Helper\AbstractHelper;

/**
 * Form Renderer
 *
 * @category SxBootstrap
 * @package SxBootstrap_View
 * @subpackage Helper
 */
class Form extends AbstractHelper
{
    /**
     * @var Zend\View\Helper\Form
     */
    protected $formHelper;

    /**
     * @var SxBootstrap\View\Helper\Bootstrap\FormElement
     */
    protected $formElementHelper;

    /**
     * Set Form Element Helper
     *
     * @param SxBootstrap\View\Helper\Bootstrap\FormElement $helper
     *
     * @return SxBootstrap\View\Helper\Bootstrap\Form
     */
    public function setElementHelper(FormElement $helper)
    {
        $helper->setView($this->getView());
        $this->formElementHelper = $helper;
    }

    /**
     * Get Form Element Helper
     *
     * @return SxBootstrap\View\Helper\Bootstrap\FormElement
     */
    public function getElementHelper()
    {
        if (!$this->formElementHelper) {
            $this->setElementHelper(new FormElement());
        }

        return $this->formElementHelper;
    }

    /**
     * Set Form Helper
     *
     * @param Zend\Form\View\Helper\Form $form
     *
     * @return Form
     */
    public function setFormHelper(FormHelper $form)
    {
        $form->setView($this->getView());
        $this->formHelper = $form;

        return $this;
    }

    /**
     * Get Form Helper
     *
     * @return Zend\Form\View\Helper\Form
     */
    public function getFormHelper()
    {
        if (!$this->formHelper) {
            $this->setFormHelper($this->view->plugin('form'));
        }

        return $this->formHelper;
    }

    /**
     * Display a Form
     *
     * @param Zend\Form\Form $form
     *
     * @return void
     */
    public function __invoke(ZendForm $form)
    {
        $form->prepare();
        $html = $this->getFormHelper()->openTag($form);
        $html .= $this->render($form->getIterator());

        return $html . $this->getFormHelper()->closeTag();
    }

    /**
     * Render the Form
     * Handles tranversable since we get a priority queue
     * or a fieldset which is basically an iterator.
     *
     * @param Traversable $fieldset
     *
     * @return void
     */
    public function render(Traversable $fieldset)
    {
        $form = '';
        $elementHelper = $this->getElementHelper();
        foreach ($fieldset as $element) {
            if ($element instanceof Collection) {
                $helper = $this->getView()->plugin('form_collection');
                $helper->setElementHelper($elementHelper);
                $form .= $helper($element);
            } elseif ($element instanceof Fieldset) {
                $form .= $this->renderFieldset($element);
            } elseif ($element instanceof ElementInterface) {
                $form .= $elementHelper->render($element);
            }
        }

        return $form;
    }

    /**
     * Render a Fieldset
     *
     * @param Zend\Form\Fieldset $fieldset
     *
     * @return void
     */
    public function renderFieldset(Fieldset $fieldset)
    {
        $id = $fieldset->getAttribute('id') ?: $fieldset->getName();

        return '<fieldset id="fieldset-' . $id . '">'
            . $this->render($fieldset)
            . '</fieldset>';
    }
}
