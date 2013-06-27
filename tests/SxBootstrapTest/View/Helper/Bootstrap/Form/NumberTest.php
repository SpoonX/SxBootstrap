<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Number;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Number */
        $helper     = new Number();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('number', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Number', $helper);
    }

    public function testMin()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Number', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('min', '-13.37')
            ->will($this->returnSelf());

        $helper->min(-13.37);
    }

    public function testMax()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Number', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('max', '1.337E+42')
            ->will($this->returnSelf());

        $helper->max(1.337E+42);
    }

    public function testStep()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Number', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('step', '42')
            ->will($this->returnSelf());

        $helper->step(42);
    }
}
