<?php

namespace SxBootstrap\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\AbstractElementHelper;
use SxCore\Html\HtmlElement;
use Zend\Form\ElementInterface;

class Input extends AbstractElementHelper
{

    /**
     * @param \Zend\Form\ElementInterface|string|null $elementType
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function __invoke($elementType = null)
    {
        $this->setElement(new HtmlElement('input'));

        if (is_object($elementType) && $elementType instanceof ElementInterface) {
            return $this->initFormElement($elementType);
        }

        if (is_string($elementType)) {
            $this->type($elementType);
        }

        return clone $this;
    }

    /**
     * @param ElementInterface $element
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    protected function initFormElement(ElementInterface $element)
    {
        $this->name($element->getName())->type('text');

        $this->getElement()->addAttributes($element->getAttributes());

        $type = $element->getAttribute('type');

        if (null !== $type) {
            $this->type(strtolower($type));
        }

        $this->value($element->getValue());

        return $this;
    }

    /**
     * @param $placeholder
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function placeholder($placeholder)
    {
        $this->addAttribute('placeholder', $placeholder);

        return $this;
    }

    /**
     * @param string $type
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function type($type)
    {
        $this->addAttribute('type', $type);

        return $this;
    }

    /**
     * @param string $value
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function value($value)
    {
        $this->addAttribute('value', (string) $value);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function name($name)
    {
        $this->addAttribute('name', $name);

        return $this;
    }

    /**
     * Display mini input
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function mini()
    {
        return $this->addClass('input-mini');
    }

    /**
     * Display small input
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function small()
    {
        return $this->addClass('input-small');
    }

    /**
     * Display medium input
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function medium()
    {
        return $this->addClass('input-medium');
    }

    /**
     * Display large input
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function large()
    {
        return $this->addClass('input-large');
    }

    /**
     * Display xlarge input
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function xlarge()
    {
        return $this->addClass('input-xlarge');
    }

    /**
     * Display xxlarge input
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Form\Input
     */
    public function xxlarge()
    {
        return $this->addClass('input-xxlarge');
    }

    /**
     * Return the HTML string of this HTML element
     *
     * @return string
     */
    public function render()
    {
        /* @var $doctypeHelper \Zend\View\Helper\Doctype */
        $doctypeHelper = $this->getView()->plugin('doctype');

        $this->getElement()->setIsXhtml($doctypeHelper->isXhtml());

        return parent::render();
    }
}
