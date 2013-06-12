<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;
use SxBootstrap\View\Helper\Bootstrap\Button as SxButton;

class ButtonGroup extends AbstractElementHelper
{

    /**
     * Contains all buttons in array or Zend\Form\Element\Button
     *
     * @param array $buttons
     */
    protected $buttons = array();

    /**
     * Render buttongroup
     *
     * @return string
     */
    public function render()
    {
        foreach ($this->buttons as $button) {
            $this->getElement()->appendContent($this->renderButton($button));
        }

        return $this->getElement()->render();
    }

    /**
     * Render buttons
     *
     * @param mixed $button
     */
    protected function renderButton($button)
    {
        if ($button instanceOf SxButton) {
            return $button->render();
        }

        return $this->getView()->plugin('sxb_button')->__invoke($button)->render();
    }

    /**
     * Add button
     *
     * @param mixed $button
     */
    public function addButton($button)
    {
        $this->buttons[] = $button;
    }

    /**
     *  Make button group element and add buttons
     *
     * @param  array $buttons
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\ButtonGroup
     */
    public function __invoke(array $buttons = array())
    {
        $this->setElement(new HtmlElement);

        $this->buttons = array();

        $this->addClass('btn-group');

        foreach ($buttons as $button) {
            $this->addButton($button);
        }

        return clone $this;
    }

    /**
     * Add checkbox data to group
     */
    public function checkbox()
    {
        $this->getElement()->addAttribute('data-toggle', 'buttons-checkbox');

        return $this;
    }

    /**
     * Add radio data to group
     */
    public function radio()
    {
        $this->getElement()->addAttribute('data-toggle', 'buttons-radio');

        return $this;
    }

    /**
     * Add vertical class to group
     */
    public function vertical()
    {
        $this->getElement()->addClass('btn-group-vertical');

        return $this;
    }

}
