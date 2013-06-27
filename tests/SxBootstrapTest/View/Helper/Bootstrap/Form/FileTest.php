<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\File;

class FileTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\File */
        $helper     = new File();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('file', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\File', $helper);
    }

    public function testAcceptWithString()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\File', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('accept', 'image/*')
            ->will($this->returnSelf());

        $helper->accept('image/*');
    }

    public function testAcceptWithArray()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\File', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('accept', 'message/http,multipart/form-data,text/xml')
            ->will($this->returnSelf());

        $helper->accept(array(
            'message/http',
            'multipart/form-data',
            'text/xml',
        ));
    }

    public function testMultiple()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\File', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('multiple', '')
            ->will($this->returnSelf());

        $helper->multiple();
    }
}
