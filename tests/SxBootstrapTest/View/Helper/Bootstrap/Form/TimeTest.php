<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Time;

class TimeTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Time */
        $helper     = new Time();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('time', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Time', $helper);
    }

    public function testMin()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Time', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('min', '09:25:42')
            ->will($this->returnSelf());

        $helper->min('09:25:42');
    }

    public function testMax()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Time', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('max', '23:14:08')
            ->will($this->returnSelf());

        $helper->max('23:14:08');
    }

    public function testStep()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Time', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('step', '42')
            ->will($this->returnSelf());

        $helper->step(42);
    }
}
