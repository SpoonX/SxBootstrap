<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;

class ButtonToolbar extends AbstractElementHelper
{

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
            $this->getElement()->appendContent($group->render());
        }

        return $this->getElement()->render();
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
     * Make button toolbar element and add groups
     *
     * @param  array $groups
     * @return \SxBootstrap\View\Helper\Bootstrap\ButtonToolbar
     */
    public function __invoke(array $groups = array())
    {
        $this->groups = array();

        $this->setElement(new HtmlElement);
        $this->addClass('btn-toolbar');

        foreach ($groups as $group) {
            $this->addGroup($group);
        }

        return clone $this;
    }

}
