<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Email;

class EmailTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Email */
        $helper     = new Email();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('email', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Email', $helper);
    }

    public function testMultiple()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Email', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('multiple', '')
            ->will($this->returnSelf());

        $helper->multiple();
    }
}
