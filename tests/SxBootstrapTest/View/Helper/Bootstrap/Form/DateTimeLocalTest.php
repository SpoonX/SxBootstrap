<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal;

class DateTimeLocalTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal */
        $helper     = new DateTimeLocal();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('datetime-local', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal', $helper);
    }

    public function testMin()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('min', '1970-01-01 00:00:00.000')
            ->will($this->returnSelf());

        $helper->min('1970-01-01 00:00:00.000');
    }

    public function testMax()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('max', '2038-01-19 03:14:08.000')
            ->will($this->returnSelf());

        $helper->max('2038-01-19 03:14:08.000');
    }

    public function testStep()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\DateTimeLocal', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('step', '42')
            ->will($this->returnSelf());

        $helper->step(42);
    }
}
