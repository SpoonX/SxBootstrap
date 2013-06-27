<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\DateTime;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\DateTime */
        $helper     = new DateTime();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('datetime', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\DateTime', $helper);
    }

    public function testMin()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\DateTime', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('min', '2011-11-12 06:54:39.929-08:00')
            ->will($this->returnSelf());

        $helper->min('2011-11-12 06:54:39.929-08:00');
    }

    public function testMax()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\DateTime', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('max', '2038-01-19 03:14:08.000+00:00')
            ->will($this->returnSelf());

        $helper->max('2038-01-19 03:14:08.000+00:00');
    }

    public function testStep()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\DateTime', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('step', '42')
            ->will($this->returnSelf());

        $helper->step(42);
    }
}
