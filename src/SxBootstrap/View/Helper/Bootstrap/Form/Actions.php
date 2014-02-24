<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;

class Actions extends AbstractElementHelper
{
    /**
     * @param null|string|array $action
     *
     * @return Actions
     */
    public function __invoke($action = null)
    {
        $this->setElement(new HtmlElement);

        if (is_array($action)) {
            $this->addContents($action);
        } elseif (null !== $action) {
            $this->addContent($action);
        }

        $this->addClass('form-group');
        $this->getElement()->spawnChild()->addClass('col-sm-offset-2 col-sm-10');

        return clone $this;
    }

    /**
     * @param string $action
     *
     * @return AbstractElementHelper
     */
    public function addContent($action)
    {
        $element  = $this->getElement();
        $children = $element->getChildren();

        $children[0]->appendContent($action . ' ');

        return $element;
    }

    /**
     * @param array $actions
     *
     * @return Actions
     */
    public function addContents(array $actions)
    {
        foreach ($actions as $action) {
            $this->addContent($action);
        }

        return $this;
    }
}
