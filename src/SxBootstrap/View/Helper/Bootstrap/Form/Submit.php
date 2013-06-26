<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

class Submit extends Input
{

    /**
     * Renders submit input type
     *
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function __invoke($elementType = null)
    {
        return parent::__invoke($elementType)->type('submit')->addClass('btn');
    }

    /**
     * Display a Primary button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function primary()
    {
        return $this->addClass('btn-primary');
    }

    /**
     * Display a Info button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function info()
    {
        return $this->addClass('btn-info');
    }

    /**
     * Display a Success button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function success()
    {
        return $this->addClass('btn-success');
    }

    /**
     * Display a Warning button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function warning()
    {
        return $this->addClass('btn-warning');
    }

    /**
     * Display a Danger button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function danger()
    {
        return $this->addClass('btn-danger');
    }

    /**
     * Display a Inverse button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function inverse()
    {
        return $this->addClass('btn-inverse');
    }

    /**
     * Display a link button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
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
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
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
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function toggle($toggle)
    {
        $this->addAttribute('data-toggle', (string) $toggle);

        return $this;
    }

    /**
     * Display mini button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function mini()
    {
        return $this->addClass('btn-mini');
    }

    /**
     * Display small button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function small()
    {
        return $this->addClass('btn-small');
    }

    /**
     * Display large button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function large()
    {
        return $this->addClass('btn-large');
    }

    /**
     * Display block button
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function block()
    {
        return $this->addClass('btn-block');
    }

    /**
     * Set button disabled
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function disabled()
    {
        return $this->addClass('disabled');
    }

    /**
     * Set button active
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Submit
     */
    public function active()
    {
        return $this->addClass('active');
    }
}
