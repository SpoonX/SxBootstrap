<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxCore\Html\HtmlElement;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow;
use Zend\View\Helper\AbstractHelper;
use SxBootstrap\Exception;

class Row extends AbstractHelper
{

    /**
     * @param array|ElementInterface $elements
     * @param boolean                $actions
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper|Actions|FormGroup
     */
    public function __invoke($elements, $actions = false)
    {
        return $actions ? $this->renderActionsRow($elements) : $this->renderRow($elements);
    }

    /**
     * @param ElementInterface $element
     *
     * @return FormGroup
     */
    public function renderRow(ElementInterface $element)
    {
        /* @var $rowPlugin \SxBootstrap\View\Helper\Bootstrap\Form\FormGroup */
        $rowPlugin   = $this->getView()->plugin('sxb_form_form_group');
        $rowPlugin   = $rowPlugin();
        $errors      = $this->renderError($element);
        $description = $this->renderDescription($element);

        if (null !== $errors) {
            $rowPlugin->error();
        }

        if ('checkbox' != $element->getAttribute('type')) {
            $label       = $this->renderLabel($element);
            $controls    = $this->renderControls($element, null !== $errors ? $errors : $description);
            $rowPlugin->addContents(array(
                $label,
                $controls,
            ));
        } else {
            $rowPlugin->addContents(array(
                $this->renderControlsCheckbox($element, null !== $errors ? $errors : $description)
            ));
        }

        return $rowPlugin;
    }

    /**
     * @param $actions
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper|Actions
     * @throws \SxBootstrap\Exception\RuntimeException
     */
    public function renderActionsRow($actions)
    {
        /* @var $rowPlugin     \SxBootstrap\View\Helper\Bootstrap\Form\Actions */
        /* @var $elementPlugin \SxBootstrap\View\Helper\Bootstrap\Form\Element */
        $rowPlugin     = $this->getView()->plugin('sxb_form_actions');
        $rowPlugin     = $rowPlugin();
        $elementPlugin = $this->getView()->plugin('sxb_form_element');

        if ($actions instanceof ElementInterface) {
            return $rowPlugin->addContent($elementPlugin($actions));
        }

        if (!is_array($actions)) {
            throw new Exception\RuntimeException(
                'Invalid actions type supplied'
            );
        }

        foreach ($actions as $action) {
            $rowPlugin->addContent($elementPlugin($action));
        }

        return $rowPlugin;
    }

    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    protected function renderLabel(ElementInterface $element)
    {
        $labelPlugin = $this->getView()->plugin('sxb_form_control_label');
        $label       = $element->getLabel();

        if (null !== $label) {
            $label = $labelPlugin($label, $element->getName(), $element->getLabelAttributes());
        }

        return $label;
    }

    /**
     * @param ElementInterface $element
     * @param null|string      $help
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Controls
     */
    protected function renderControlsCheckbox(ElementInterface $element, $help = null)
    {
        $elementPlugin  = $this->getView()->plugin('sxb_form_element');
        $controlsPlugin = $this->getView()->plugin('sxb_form_controls');
        $controls = array(
            'controls' => (string) $elementPlugin($element),
            'help' => $help,
        );

        $checkbox = new HtmlElement();
        $checkbox->addClass('checkbox');

        $label = $this->renderLabel($element);
        if ($element->getOption('label_position') == FormRow::LABEL_PREPEND) {
            $label->getElement()->appendContent($controls['controls']);
        } else {
            $label->getElement()->prependContent($controls['controls']);
        }

        $checkbox->appendContent((string) $label);

        $controls['controls'] = (string) $checkbox;

        return $controlsPlugin($controls, $element->getOption('wrapper-class'));
    }

    /**
     * @param ElementInterface $element
     * @param null|string      $help
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Controls
     */
    protected function renderControls(ElementInterface $element, $help = null)
    {
        $elementPlugin  = $this->getView()->plugin('sxb_form_element');
        $controlsPlugin = $this->getView()->plugin('sxb_form_controls');

        return $controlsPlugin(
            array(
                (string) $elementPlugin($element),
                $help,
            ),
            $element->getOption('wrapper-class')
        );
    }

    /**
     * @param ElementInterface $element
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Description
     */
    protected function renderDescription(ElementInterface $element)
    {
        $descriptionPlugin = $this->getView()->plugin('sxb_form_description');

        return $descriptionPlugin($element);
    }

    /**
     * Render errors.
     *
     * @param ElementInterface $element
     *
     * @return null|\SxBootstrap\View\Helper\Bootstrap\Form\Errors
     */
    protected function renderError(ElementInterface $element)
    {
        $messages = $element->getMessages();

        if (empty($messages)) {
            return null;
        }

        $errorPlugin = $this->getView()->plugin('sxb_form_errors');

        return $errorPlugin($element);
    }
}
