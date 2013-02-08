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
        $scriptHelper = $this->view->plugin('head_script');
        $baseHelper   = $this->view->plugin('base_path');

        $scriptHelper->prependFile($baseHelper('/js/bootstrap.js'));
    }

    protected function prependCss()
    {
        $linkHelper = $this->view->plugin('head_link');
        $baseHelper = $this->view->plugin('base_path');

        $linkHelper->prependStylesheet($baseHelper('/css/bootstrap.css'));
    }
}
