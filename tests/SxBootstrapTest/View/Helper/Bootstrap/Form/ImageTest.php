<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Image;

class ImageTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Image */
        $helper     = new Image();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('image', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Image', $helper);
    }

    public function testAlt()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Image', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('alt', 'Someday we&#39;ll have xmonad as a Firefox extension.')
            ->will($this->returnSelf());

        $helper->alt('Someday we&#39;ll have xmonad as a Firefox extension.');
    }

    public function testSrc()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Image', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('src', '//imgs.xkcd.com/comics/mac_pc.png')
            ->will($this->returnSelf());

        $helper->src('//imgs.xkcd.com/comics/mac_pc.png');
    }

    public function testHeight()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Image', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('height', '600')
            ->will($this->returnSelf());

        $helper->height(600);
    }

    public function testWidth()
    {
        $helper = $this->getMock('\SxBootstrap\View\Helper\Bootstrap\Form\Image', array('addAttribute'));

        $helper->expects($this->once())
            ->method('addAttribute')
            ->with('width', '800')
            ->will($this->returnSelf());

        $helper->width(800);
    }
}
