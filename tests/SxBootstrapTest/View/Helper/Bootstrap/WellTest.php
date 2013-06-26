<?php

namespace SxBootstrapTest\View\Helper\Bootstrap;

use PHPUnit_Framework_TestCase;
use SxBootstrap\View\Helper\Bootstrap\Well;

/**
 * @covers SxBootstrap\View\Helper\Bootstrap\Well
 */
class WellTest extends PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Well */
        $wellHelper = new Well();
        $instance    = $wellHelper();
        $attributes  = $instance->getElement()->getAttributes();
        $expected    = '<div class="well"></div>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Well', $instance);
        $this->assertSame('well', $attributes['class']);
        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeMessage()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Well */
        $wellHelper = new Well();
        $instance    = $wellHelper('test');
        $attributes  = $instance->getElement()->getAttributes();
        $expected    = '<div class="well">test</div>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Well', $instance);
        $this->assertSame('well', $attributes['class']);
        $this->assertSame($expected, (string) $instance);
    }
    
    public function testLarge()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Well */
        $wellHelper = new Well();
        $instance    = $wellHelper();

        $instance->large();

        $attributes = $instance->getElement()->getAttributes();

        $this->assertSame('well well-large', $attributes['class']);
    }
    
    public function testSmall()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Well */
        $wellHelper = new Well();
        $instance    = $wellHelper();

        $instance->small();

        $attributes = $instance->getElement()->getAttributes();

        $this->assertSame('well well-small', $attributes['class']);
    }
    
    public function testRender()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Well */
        $wellHelper = new Well();
        $instance    = $wellHelper();

        $instance->render();

        $attributes = $instance->getElement()->getAttributes();
        $expected    = '<div class="well"></div>';
        $this->assertSame($expected, (string) $instance);
    }
}
