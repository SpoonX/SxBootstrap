<?php
namespace SxBootstrap\View\Helper\Bootstrap;

//use SxBootstrap\Exception;
use Zend\View\Helper\AbstractHelper;

/**
 * ViewHelper to add twitter bootstrap to the head.
 * This WILL use the headScript and headLink helpers.
 */
class Bootstrap extends AbstractHelper
{
    public function __invoke()
    {
        $this->prependCss();
        $this->prependJs();
    }

    protected function prependJs()
    {
        $this->getView()->headScript()->prependFile(
            $this->getView()->basePath() . '/js/bootstrap.js'
        );
    }

    protected function prependCss()
    {
        $this->getView()->headLink()->prependStylesheet(
            $this->getView()->basePath() . '/css/bootstrap.css'
        );
    }
}
