<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\AbstractHelper;
use SxBootstrap\Exception;
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
     * @return string
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
     * @param string $class
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function addClass($class)
    {
        $currClasses = $this->element->getAttribute('class');

        if (!empty($currClasses)) {
            $class = $currClasses . " $class";
        }

        $this->element->setAttribute('class', $class);

        return $this;
    }

    /**
     * Add attribute on button element
     *
     * @param string $key
     * @param string $value
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function addAttribute($key, $value)
    {
        $this->element->setAttribute($key, $value);

        return $this;
    }

    /**
     * Get arguments and make button element
     *
     * @param mixed $argument
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function __invoke($argument = null)
    {
        $this->element = null;

        if (null === $argument) {
            $this->element = new ButtonElement;
        } elseif ($argument instanceof ElementInterface) {
            $this->element = $argument;
        } elseif (is_string($argument)) {
            $this->element = new ButtonElement;
            $this->element->setName($argument);
        } elseif (is_array($argument)) {
            $this->element = new ButtonElement;
            $this->element->setAttributes($argument);
        } else {
            throw new Exception\InvalidArgumentException(
                'Expected either array or "Zend\Form\ElementInterface", got ' . gettype($argument)
            );
        }

        $name = $this->element->getName();

        if (empty($name)) {
            $name = 'sxbButton';
            $this->element->setName($name);
        }

        return clone $this->setLabel($name)->addClass('btn');
    }

    /**
     * Display button
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Set label or value based on type
     *
     * @param string $label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function setLabel($label)
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
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function primary()
    {
        return $this->addClass('btn-primary');
    }

    /**
     * Display a Info button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function info()
    {
        return $this->addClass('btn-info');
    }

    /**
     * Display a Success button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function success()
    {
        return $this->addClass('btn-success');
    }

    /**
     * Display a Warning button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function warning()
    {
        return $this->addClass('btn-warning');
    }

    /**
     * Display a Danger button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function danger()
    {
        return $this->addClass('btn-danger');
    }

    /**
     * Display a Inverse button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function inverse()
    {
        return $this->addClass('btn-inverse');
    }

    /**
     * Display a link button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function link()
    {
        return $this->addClass('btn-link');
    }

    /**
     * Display data-loading-text text
     *
     * @param string $text
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function loadingText($text)
    {
        $this->element->setAttribute('data-loading-text', $text);

        return $this;
    }

    /**
     * Display data-toggle text
     *
     * @param string $text
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function toggle($toggle)
    {
        $this->element->setAttribute('data-toggle', $toggle);

        return $this;
    }

    /**
     * Display mini button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function mini()
    {
        return $this->addClass('btn-mini');
    }

    /**
     * Display small button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function small()
    {
        return $this->addClass('btn-small');
    }

    /**
     * Display large button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function large()
    {
        return $this->addClass('btn-large');
    }

    /**
     * Display block button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function block()
    {
        return $this->addClass('btn-block');
    }

    /**
     * Set button disabled
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function disabled()
    {
        return $this->addClass('disabled');
    }

    /**
     * Set button active
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function active()
    {
        return $this->addClass('active');
    }

}
