<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\AbstractHelper;
use SxBootstrap\Exception;
use Zend\Form\View\Helper\FormButton;
use Zend\Form\Element;
use Zend\Form\Element\Button as ButtonElement;
use Zend\Form\ElementInterface;

class Button extends AbstractHelper
{

    /**
    * @var \Zend\Form\ElementInterface
    */
    protected $element;

    /**
     * Render button
     *
     * @return  string
     */
    public function render()
    {
        if ($this->element->getAttribute('type') === 'submit') {
            $plugin = 'form_submit';
            $label  = $this->element->getValue();
        } else {
            $plugin = 'form_button';
            $label  = $this->element->getLabel();
        }

        return $this->getView()->plugin($plugin)->render(
            $this->element,
            $label
        );
    }

    /**
     * Add class to button
     *
     * @param   string  $class
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    protected function addClass($class)
    {
        $class = $this->element->getAttribute('class') . " $class";

        $this->element->setAttribute('class', $class);

        return $this;
    }

    /**
     * Get arguments and make button element
     *
     * @param   mixed  args
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function __invoke()
    {
        $args = func_get_args();

        if (count($args) > 1) {
            throw new Exception\InvalidArgumentException(
                'Expected exactly 1 argument. Got ' . count($args) . '.'
            );
        }

        if (count($args) === 0) {
            $this->element = new ButtonElement;
        } elseif (!empty($args[0]) && $args[0] instanceof ElementInterface) {
            $this->element = $args[0];
        } elseif(is_string($args[0])) {
            $this->element = new ButtonElement;
            $this->element->setName($args[0]);
        } elseif(is_array($args[0])) {
            $this->element = new ButtonElement;
            $this->element->setAttributes($args[0]);
        } else {
            throw new Exception\InvalidArgumentException(
                'Expected either array or "Zend\Form\ElementInterface", got ' . gettype($args[0])
            );
        }

        $name = $this->element->getName();
        if (empty($name)) {
            $name = 'sxbButton';
            $this->element->setName($name);
        }

        $this->label($name)->element->setAttribute('class', 'btn');

        return $this;
    }

    /**
     * Display button
     *
     * @return  string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Set label or value based on type
     *
     * @param   string  $label
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function label($label)
    {
        if ($this->element->getAttribute('type') === 'submit') {
            $this->element->setValue($label);

            return $this;
        }

        $this->element->setLabel($label);

        return $this;
    }

    /**
     * Display a Primary button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function primary($text)
    {
        return $this->addClass('btn-primary');
    }

    /**
     * Display a Info button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function info()
    {
        return $this->addClass('btn-info');
    }

    /**
     * Display a Success button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function success()
    {
        return $this->addClass('btn-success');
    }

    /**
     * Display a Warning button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function warning()
    {
        return $this->addClass('btn-warning');
    }

    /**
     * Display a Danger button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function danger()
    {
        return $this->addClass('btn-danger');
    }

    /**
     * Display a Inverse button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function inverse()
    {
        return $this->addClass('btn-inverse');
    }

    /**
     * Display a link button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function link()
    {
        return $this->addClass('btn-link');
    }

    /**
     * Display data-loading-text text
     *
     * @param   string $text
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function loadingText($text)
    {
        $this->element->setAttribute('data-loading-text', $text);

        return $this;
    }

    /**
     * Display data-toggle text
     *
     * @param   string $text
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function toggle($toggle)
    {
        $this->element->setAttribute('data-toggle', $toggle);

        return $this;
    }

    /**
     * Display mini button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function mini()
    {
        return $this->addClass('btn-mini');
    }

    /**
     * Display small button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function small()
    {
        return $this->addClass('btn-small');
    }

    /**
     * Display large button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function large()
    {
        return $this->addClass('btn-large');
    }

    /**
     * Display block button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function block()
    {
        return $this->addClass('btn-block');
    }

    /**
     * Display disabled button
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function disabled()
    {
        return $this->addClass('disabled');
    }

}
