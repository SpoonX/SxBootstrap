<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;
use SxBootstrap\Exception;

class Modal extends AbstractElementHelper
{

    /** @var string */
    protected $backdrop;

    /** @var string */
    protected $body;

    /** @var bool */
    protected $closeButton = false;

    /** @var string */
    protected $footer;

    /** @var string */
    protected $header;

    /** @var string */
    protected $keyboard;

    /** @var string */
    protected $show;

    /** @var string */
    protected $remote;

    /**
     * Renders a given ViewModel or passes the argument verbatim
     *
     * @param  string|\Zend\View\Model\ViewModel $content
     *
     * @return string
     */
    protected function maybeRender($content)
    {
        if ($content instanceof ViewModel) {
            $content = $this->getView()->render($content);
        }

        return (string)$content;
    }

    /**
     * Returns the backdrop Bootstrap option
     *
     * @return string
     */
    public function getBackdrop()
    {
        return $this->backdrop;
    }

    /**
     * Sets the Bootstrap backdrop option
     *
     * @param string $backdrop
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setBackdrop($backdrop)
    {
        $this->backdrop = (string)$backdrop;

        return $this;
    }

    /**
     * Returns the body div content
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets the body div content
     *
     * @param string|\Zend\View\Model\ViewModel         $body
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setBody($body)
    {
        $this->body = $this->maybeRender($body);

        return $this;
    }

    /**
     * Determine if modal will have a close button
     *
     * @return bool
     */
    public function hasCloseButton()
    {
        return $this->closeButton;
    }

    /**
     * Change whether modal will get a close button
     *
     * @param bool $closeButton
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setCloseButton($closeButton)
    {
        $this->closeButton = (bool)$closeButton;

        return $this;
    }

    /**
     * Returns the footer div content
     *
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Sets the footer div content
     *
     * @param string|\Zend\View\Model\ViewModel         $footer
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setFooter($footer)
    {
        $this->footer = $this->maybeRender($footer);

        return $this;
    }

    /**
     * Returns the header div content
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Sets the header div content
     *
     * @param string|\Zend\View\Model\ViewModel         $header
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setHeader($header)
    {
        $this->header = $this->maybeRender($header);

        return $this;
    }

    /**
     * Returns the Bootstrap keyboard option
     *
     * @return string
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * Sets the Bootstrap keyboard option
     *
     * @param string $keyboard
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setKeyboard($keyboard)
    {
        $this->keyboard = (string)$keyboard;

        return $this;
    }

    /**
     * Returns the Bootstrap show option
     *
     * @return string
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Sets the Bootstrap show option
     *
     * @param string $show
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setShow($show)
    {
        $this->show = (string)$show;

        return $this;
    }

    /**
     * Returns the Bootstrap remote option
     *
     * @return string
     */
    public function getRemote()
    {
        return $this->remote;
    }

    /**
     * Sets the Bootstrap remote option
     *
     * @param string $remote
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function setRemote($remote)
    {
        $this->remote = (string)$remote;

        return $this;
    }

    /**
     * Create modal element
     *
     * @param null|string|\Zend\View\Model\ViewModel $body
     * @param null|string|\Zend\View\Model\ViewModel $footer
     * @param null|string|\Zend\View\Model\ViewModel $header
     * @param null|boolean                           $closeButton
     *
     * @return  \SxBootstrap\View\Helper\Bootstrap\Modal
     */
    public function __invoke(
        $body        = null,
        $footer      = null,
        $header      = null,
        $closeButton = null
    ) {
        $htmlElement = new   HtmlElement();
        $retVal      = clone $this;

        $retVal->setElement($htmlElement);

        if (!is_null($closeButton)) {
            $retVal->setCloseButton($closeButton);
        }
        if (!is_null($header)) {
            $retVal->setHeader($header);
        }
        if (!is_null($body)) {
            $retVal->setBody($body);
        }
        if (!is_null($footer)) {
            $retVal->setFooter($footer);
        }

        return $retVal;
    }

    /**
     * Returns close button
     *
     * @return string
     */
    protected function renderCloseButton()
    {
        $button = new HtmlElement('button');

        return $button
            ->addAttributes(array(
                'type'         => 'button',
                'data-dismiss' => 'modal',
                'aria-hidden'  => 'true',
            ))
            ->addClass('close')
            ->setContent('&times;')
            ->render();
    }

    /**
     * Returns data attributes from options
     *
     * @return array
     */
    protected function getDataAttributes()
    {
        $ret        = array();
        $properties = array(
            'backdrop',
            'keyboard',
            'show',
            'remote',
        );

        foreach ($properties as $property) {
            $value = $this->{'get'.$property}();

            if ($value) {
                $ret['data-' . $property] = $value;
            }
        }

        return $ret;
    }

    /**
     * Render markup
     *
     * @return  string
     */
    public function render()
    {
        $body = $this->getBody();
        if (!$body) {
            throw new Exception\RuntimeException(
                'Body has not been set'
            );
        }

        $element = $this->getElement();
        $header  = ($this->hasCloseButton() ? $this->renderCloseButton() : '')
            . $this->getHeader();

        if ($header) {
            $element->spawnChild('div')
                ->setContent($header)
                ->addClass('modal-header');
        }

        $element->spawnChild('div')
            ->setContent($body)
            ->addClass('modal-body');

        $footer = $this->getFooter();
        if ($footer) {
            $element->spawnChild('div')
                ->setContent($footer)
                ->addClass('modal-footer');
        }

        $element
            ->addClass('modal')
            ->addAttributes($this->getDataAttributes());

        return $element->render();
    }

}
