<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Submit;
use SxCore\Html\HtmlElement;

class SubmitTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Submit */
        $helper     = new Submit();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('submit', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Submit', $helper);
    }

    public function testValue()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Submit', array('addAttribute', 'translate'));

        $helper->expects($this->once())
            ->method('translate')
            ->with('caravan')
            ->will($this->returnValue('sleurhut'));
        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('value', 'sleurhut')
            ->will($this->returnSelf());

        $helper->value('caravan');
    }

    public function provideSubmitClasses()
    {
        return array(
            array('primary', 'btn-primary'),
            array('info', 'btn-info'),
            array('success', 'btn-success'),
            array('warning', 'btn-warning'),
            array('danger', 'btn-danger'),
            array('inverse', 'btn-inverse'),
            array('link', 'btn-link'),
            array('mini', 'btn-mini'),
            array('small', 'btn-small'),
            array('large', 'btn-large'),
            array('block', 'btn-block'),
            array('disabled', 'disabled'),
            array('active', 'active'),
        );
    }

    /**
     * @dataProvider provideSubmitClasses
     */
    public function testClasses($method, $class)
    {
        $helper      = $this->getMock(
            '\SxBootstrap\View\Helper\Bootstrap\Form\Submit',
            array('addClass')
        );
        $htmlElement = $this->getMock(
            '\SxCore\Html\HtmlElement',
            array('addClass')
        );

        $htmlElement->expects($this->once())
            ->method('addClass')
            ->with($class)
            ->will($this->returnSelf());
        $helper->setElement($htmlElement);

        $helper->$method();
    }

    public function testLoadingText()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Submit', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('data-loading-text', 'Please wait…')
            ->will($this->returnSelf());

        $helper->loadingText('Please wait…');
    }

    public function testToggle()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Submit', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('data-toggle', '#main_screen')
            ->will($this->returnSelf());

        $helper->toggle('#main_screen');
    }
}
