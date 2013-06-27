<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Month;

class MonthTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Month */
        $helper     = new Month();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('month', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Month', $helper);
    }

    public function testMin()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Month', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('min', '1996-12')
            ->will($this->returnSelf());

        $helper->min('1996-12');
    }

    public function testMax()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Month', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('max', '2038-01')
            ->will($this->returnSelf());

        $helper->max('2038-01');
    }

    public function testStep()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Month', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('step', '42')
            ->will($this->returnSelf());

        $helper->step(42);
    }
}
