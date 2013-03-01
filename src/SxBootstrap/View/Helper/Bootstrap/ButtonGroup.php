<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\AbstractHelper;
use SxBootstrap\Exception;
use SxBootstrap\Html\HtmlElement as HtmlElement;
use SxBootstrap\View\Helper\Bootstrap\Button as SxButton;
use Zend\Form\Element\Button as ButtonElement;
use Zend\Form\ElementInterface;

class ButtonGroup extends AbstractHelper
{
    /**
     * @var SxBootstrap\Html\HtmlElement
     */
    protected $group;

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
        foreach($this->buttons as $button) {
            $this->group->appendContent($this->renderButton($button));
        }

        return $this->group->render();
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

        return $this->getView()->plugin('sxb_button')->__invoke($button);
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
     * Add class
     *
     * @param  string $class
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\ButtonGroup
     */
    public function addClass($class)
    {
        $this->group->addClass($class);

        return $this;
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
        $this->group    = new HtmlElement();
        $this->buttons  = array();

        $this->addClass('btn-group');

        foreach ($buttons as $button) {
            $this->addButton($button);
        }

        return clone $this;
    }

    /**
     * Render button group to string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Add checkbox data to group
     */
    public function checkbox()
    {
        $this->group->addAttribute('data-toggle', 'buttons-checkbox');

        return $this;
    }

    /**
     * Add radio data to group
     */
    public function radio()
    {
        $this->group->addAttribute('data-toggle', 'buttons-radio');

        return $this;
    }

     /**
     * Add vertical class to group
     */
    public function vertical()
    {
        $this->group->addClass('btn-group-vertical');

        return $this;
    }

}
