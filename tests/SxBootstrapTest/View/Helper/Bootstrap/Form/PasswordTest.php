<?php
/**
 * @author  RWOverdijk
 * @package PasswordTest
 */

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Password;

class PasswordTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Password */
        $helper     = new Password();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue(isset($attributes['type']));
        $this->assertSame('password', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Password', $helper);
    }
}
