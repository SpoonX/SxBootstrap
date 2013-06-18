<?php

/**
 * SxBootstrap
 *
 * @category SxBootstrap
 * @package SxBootstrap_View
 * @subpackage Helper
 */

namespace SxBootstrap\View\Helper\Bootstrap;

use Zend\Form\View\Helper\FormElementErrors as ZendFormElementErrors;

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
