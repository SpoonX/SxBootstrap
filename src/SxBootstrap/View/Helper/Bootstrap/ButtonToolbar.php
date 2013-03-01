<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\AbstractHelper;
use SxBootstrap\Exception;
use SxBootstrap\Html\HtmlElement as HtmlElement;
use SxBootstrap\View\Helper\Bootstrap\ButtonGroup as SxButtonGroup;
use Zend\Form\Element\ButtonGroup as ButtonGroupElement;
use Zend\Form\ElementInterface;

class ButtonToolbar extends AbstractHelper
{

    /**
     * @var SxBootstrap\Html\HtmlElement
     */
    protected $toolbar;

    /**
     * Contains all buttongroups in array or Zend\Form\Element\ButtonGroup
     *
     * @param array $groups
     */
    protected $groups = array();

    /**
     * Render toolbar
     */
    public function render()
    {
        foreach($this->groups as $group) {
            $this->toolbar->appendContent($this->renderGroup($group));
        }

        return $this->toolbar->render();
    }

    /**
     * Render groups
     *
     * @param mixed $group
     */
    protected function renderGroup($group)
    {
        if ($group instanceOf SxButtonGroup) {
            return $group->render();
        }

        return $this->getView()->plugin('sxb_button_group')->__invoke($group);
    }

    /**
     * Add group
     *
     * @param mixed $group
     */
    public function addGroup($group)
    {
        $this->groups[] = $group;
    }

    /**
     * Add class to toolbar
     *
     * @param  string $class
     * @return SxBootstrap\View\Helper\Bootstrap\ButtonToolbar
     */
    public function addClass($class)
    {
        $this->toolbar->addClass($class);

        return $this;
    }

    /**
     * Make button toolbar element and add groups
     *
     * @param  array $groups
     * @return @return SxBootstrap\View\Helper\Bootstrap\ButtonToolbar
     */
    public function __invoke(array $groups = array())
    {
        $this->toolbar  = new HtmlElement();
        $this->groups   = array();

        $this->addClass('btn-toolbar');

        foreach ($groups as $group) {
            $this->addGroup($group);
        }

        return clone $this;
    }

    /**
     * Render button toolbar to string
     */
    public function __toString()
    {
        return $this->render();
    }
}
