<?php
namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\FormInput;
use SxBootstrap\Exception;

/**
 * ViewHelper to render "colorpicker" elements. This does require you to add the following assets:
 *  - public/js/bootstrap-colorpicker.js
 *  - public/css/colorpicker.css
 * And make sure that these are accessible:
 *  - public/img/alpha.png
 *  - public/img/hue.png
 *  - public/img/saturation.png
 *
 * After creating this element, manually call "$('colorpicker').colorpicker();"
 *
 * @see http://www.eyecon.ro/bootstrap-colorpicker/
 *
 * @todo Refactor to use less files, and improve code.
 */
class FormColorPicker extends FormInput
{
    /**
     * @var array Options for the colorpicker
     */
    protected $options;

    /**
     * Build the color picker form. Possible options are:
     *
     *   - format. The format used by the colorpicker.
     *       Allowed:    hex, rgb and rgba.
     *       Default:    hex
     *
     *   - color. The default color for the colorpicker.
     *       Default:    white. (#fff, rgb[a](255,255,255[,1]))
     *
     *   - class. The class used for the colorpicker.
     *       Default:    colorpicker.
     *
     *   - invoke_inline. Allow the view helper to invoke the colorpicker javascript.
     *       Default:    false.
     *
     *   - include_dependencies. Allow the view helper to add the dependencies to the headScript.
     *       Default:    false
     *
     * @param    Zend\Form\Element\Element   $element
     * @param    array                       $options
     *
     * @return   Zend\Form\View\Helper\FormInput
     */
    public function __invoke($element, $options = array())
    {
        $options = $this->setOptions($options);
        $this->handleDependencies();

        if ($options['as_component']) {
            return $this->assembleComponent($element);
        }

        $element = $this->prepareElement($element);
        return parent::__invoke($element);
    }

    /**
     * Put together the colorpicker component.
     *
     * @param Zend\Form\Element $element
     */
    protected function assembleComponent($element)
    {
        $options   = $this->getOptions();
        $element   = parent::__invoke($element);
        $component = sprintf(
            '<div style="padding: 0;" class="input-append color %s" data-color="%s" data-color-format="%s">%s',
            $options['class'],
            $options['color'],
            $options['format'],
            $element
        ) . sprintf(
            '<span class="add-on"><i style="background-color: %s;"></i></span></div>',
            $options['color']
        );

        return $component;
    }

    /**
     * Prepare the element by applying all changes to it required for the colorpicker.
     *
     * @param    Zend\Form\Element\Element   $element
     *
     * @return   Zend\Form\View\Helper\FormInput
     */
    protected function prepareElement($element)
    {
        $options    = $this->getOptions();
        $currClass  = $element->getAttribute('class');
        $class      = $currClass . (null !== $currClass ? ' ' : '') . $options['class'];

        $element->setAttributes(array(
            'class'             => $class,
            'data-color'        => $options['color'],
            'data-color-format' => $options['format'],
        ));

        return $element;
    }

    /**
     * Handle the dependencies (inline, head and / or leave alone)
     */
    protected function handleDependencies()
    {
        $options = $this->getOptions();

        if ($options['invoke_inline']) {
            $this->invokeInline();
        }

        if ($options['include_dependencies']) {
            $this->includeDependencies();
        }
    }

    /**
     * Get the options for the element.
     *
     * @return array The options
     */
    protected function getOptions()
    {
        return $this->options;
    }

    /**
    * Set the options for the colorpicker.
    *
    * @param    array   $options
    * @return   array   The options.
    * @throws   Exception\InvalidArgumentException
    */
    protected function setOptions($options)
    {
        $options = array_merge(array(
            'format'                => 'hex',
            'invoke_inline'         => false,
            'include_dependencies'  => false,
            'as_component'          => false,
            'class'                 => 'colorpicker',
        ), $options);

        if (!in_array($options['format'], array('hex', 'rgb', 'rgba'))) {
            throw new Exception\InvalidArgumentException(
                'Invalid format supplied. Allowed formats are "hex", "rgb" and "rgba".'
            );
        }

        $defaultColors = array(
            'hex'   => '#fff',
            'rgb'   => 'rgb(255,255,255)',
            'rgba'  => 'rgba(255,255,255,1)',
        );

        if (empty($options['color'])) {
            $options['color'] = $defaultColors[$options['format']];
        }

        return $this->options = $options;
    }

    /**
     * Invoke the colorpicker inline.
     */
    protected function invokeInline()
    {
        $options = $this->getOptions();
        $this->getView()->headScript()->appendScript("
            $(function() {
                $('.{$options['class']}').colorpicker();
            });
        ");
    }

    /**
     * Include the colorpicker dependencies.
     */
    protected function includeDependencies()
    {
        $view = $this->getView();
        $view->headScript()->appendFile($view->basePath() . '/js/bootstrap-colorpicker.js');
        $view->headLink()->prependStylesheet($view->basePath() . '/css/colorpicker.css');
    }
}
