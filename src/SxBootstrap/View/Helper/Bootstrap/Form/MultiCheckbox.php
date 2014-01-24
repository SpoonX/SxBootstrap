<?php
/**
 * Created by EBelair.
 * User: manu
 * Date: 23/01/14
 * Time: 21:33
 */

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use Zend\Form\View\Helper\FormMultiCheckbox;
use Zend\Form\Element\MultiCheckbox as MultiCheckboxElement;

class MultiCheckbox extends FormMultiCheckbox
{
    protected function renderOptions(
        MultiCheckboxElement $element,
        array $options,
        array $selectedOptions,
        array $attributes
    ) {
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $labelHelper      = $this->getLabelHelper();
        $labelClose       = $labelHelper->closeTag();
        $labelPosition    = $this->getLabelPosition();
        $globalLabelAttributes = $element->getLabelAttributes();
        $closingBracket   = $this->getInlineClosingBracket();

        if (empty($globalLabelAttributes)) {
            $globalLabelAttributes = $this->labelAttributes;
        }

        $combinedMarkup = array();
        $count          = 0;

        foreach ($options as $key => $optionSpec) {
            $count++;
            if ($count > 1 && array_key_exists('id', $attributes)) {
                unset($attributes['id']);
            }

            $value           = '';
            $label           = '';
            $inputAttributes = $attributes;
            $labelAttributes = $globalLabelAttributes;
            $selected        = isset($inputAttributes['selected']) && $inputAttributes['type'] != 'radio' && $inputAttributes['selected'] != false ? true : false;
            $disabled        = isset($inputAttributes['disabled']) && $inputAttributes['disabled'] != false ? true : false;

            if (is_scalar($optionSpec)) {
                $optionSpec = array(
                    'label' => $optionSpec,
                    'value' => $key
                );
            }

            if (isset($optionSpec['value'])) {
                $value = $optionSpec['value'];
            }
            if (isset($optionSpec['label'])) {
                $label = $optionSpec['label'];
            }
            if (isset($optionSpec['selected'])) {
                $selected = $optionSpec['selected'];
            }
            if (isset($optionSpec['disabled'])) {
                $disabled = $optionSpec['disabled'];
            }
            if (isset($optionSpec['label_attributes'])) {
                $labelAttributes = (isset($labelAttributes))
                    ? array_merge($labelAttributes, $optionSpec['label_attributes'])
                    : $optionSpec['label_attributes'];
            }
            if (isset($optionSpec['attributes'])) {
                $inputAttributes = array_merge($inputAttributes, $optionSpec['attributes']);
            }

            if (in_array($value, $selectedOptions)) {
                $selected = true;
            }

            $inputAttributes['value']    = $value;
            $inputAttributes['checked']  = $selected;
            $inputAttributes['disabled'] = $disabled;

            $input = sprintf(
                '<input %s%s',
                $this->createAttributesString($inputAttributes),
                $closingBracket
            );

            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate(
                    $label,
                    $this->getTranslatorTextDomain()
                );
            }

            $class = $inputAttributes['type'] . '-inline';

            $labelAttributes['class'] = (true === $element->getOption('inline')) ? $class : '';
            $label     = $escapeHtmlHelper($label);
            $labelOpen = $labelHelper->openTag($labelAttributes);
            $template  = $labelOpen . '%s%s' . $labelClose;
            switch ($labelPosition) {
                case self::LABEL_PREPEND:
                    $markup = sprintf($template, $label, $input);
                    break;
                case self::LABEL_APPEND:
                default:
                    $markup = sprintf($template, $input, $label);
                    break;
            }

            if (true !== $element->getOption('inline')) {
                $twbTemplate = '<div class="%s">%s</div>';
                $combinedMarkup[] = sprintf($twbTemplate, $inputAttributes['type'], $markup);
            } else {
                $combinedMarkup[] = $markup;
            }

        }

        return implode($this->getSeparator(), $combinedMarkup);
    }
}
