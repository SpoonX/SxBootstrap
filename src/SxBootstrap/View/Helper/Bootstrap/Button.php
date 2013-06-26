<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;
use Zend\Form\ElementInterface;

class Button extends AbstractElementHelper
{

    /**
     * @var \Zend\Form\ElementInterface
     */
    protected $element;

    /**
     * Get arguments and make button element
     *
     * @param string|null $label
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function __invoke($label = null)
    {
        $this->setElement(new HtmlElement('button'));

        if (is_string($label)) {
            $this->setLabel($label);
        }

        $this->addClass('btn');

        return clone $this;
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
        $this->setContent($label);

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
     * @param string $type
     */
    public function type($type)
    {
        $this->addAttribute('type', (string) $type);
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
        $this->addAttribute('data-loading-text', $text);

        return $this;
    }

    /**
     * Display data-toggle text
     *
     * @param string $toggle
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Button
     */
    public function toggle($toggle)
    {
        $this->addAttribute('data-toggle', (string) $toggle);

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
