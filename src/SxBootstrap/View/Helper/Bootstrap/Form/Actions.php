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
            $this->addActions($action);
        }

        if (null !== $action) {
            $this->addAction($action);
        }

        $this->addClass('form-actions');

        return clone $this;
    }

    /**
     * @param string $action
     *
     * @return AbstractElementHelper
     */
    public function addAction($action)
    {
        return $this->setContent($this->getElement()->getContent() . $action);
    }

    /**
     * @param array $actions
     *
     * @return Actions
     */
    public function addActions(array $actions)
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }
}
