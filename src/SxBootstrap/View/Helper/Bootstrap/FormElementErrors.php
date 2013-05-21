<?php

/**
 * SxBootstrap
 *
 * @category SxBootstrap
 * @package SxBootstrap_View
 * @subpackage Helper
 */

namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as ZendFormElement;
use Zend\Form\View\Helper\FormLabel;
use Zend\Form\View\Helper\FormElementErrors as ZendFormElementErrors;
use Zend\View\Helper\EscapeHtml;

/**
 * Form Element errors
 *
 * @category SxBootstrap
 * @package SxBootstrap_View
 * @subpackage Helper
 */
class FormElementErrors extends ZendFormElementErrors
{
    protected $messageCloseString     = '</span>';
    protected $messageOpenFormat      = '<span%s class="help-inline">';
    protected $messageSeparatorString = '</span><span%s class="help-inline">';
}
