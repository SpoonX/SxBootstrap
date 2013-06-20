<?php

namespace SxBootstrapTest\View\Helper\Bootstrap;

use PHPUnit_Framework_TestCase;
use SxBootstrap\View\Helper\Bootstrap\Badge;

/**
 * @covers SxBootstrap\View\Helper\Bootstrap\Badge
 */
class BadgeTest extends PHPUnit_Framework_TestCase
{
    public function testInvokeMessage()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Badge */
        $badgeHelper = new Badge();
        $instance    = $badgeHelper('test');
        $attributes  = $instance->getElement()->getAttributes();
        $expected    = '<span class="badge">test</span>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Badge', $instance);
        $this->assertSame('badge', $attributes['class']);
        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInfo()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Badge */
        $badgetHelper   = new Badge();
        $instance       = $badgetHelper('test');

        $instance->info();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('badge badge-info', $attributes['class']);
    }

    public function testImportant()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Badge */
        $badgetHelper   = new Badge();
        $instance       = $badgetHelper('test');

        $instance->important();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('badge badge-important', $attributes['class']);
    }
    
    public function testInverse()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Badge */
        $badgetHelper   = new Badge();
        $instance       = $badgetHelper('test');

        $instance->inverse();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('badge badge-inverse', $attributes['class']);
    }
    
    public function testSuccess()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Badge */
        $badgetHelper   = new Badge();
        $instance       = $badgetHelper('test');

        $instance->success();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('badge badge-success', $attributes['class']);
    }    
    
    public function testWarning()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Badge */
        $badgetHelper   = new Badge();
        $instance       = $badgetHelper('test');

        $instance->warning();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('badge badge-warning', $attributes['class']);
    }
    
    public function testRender()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Well */
        $badgetHelper   = new Badge();
        $instance       = $badgetHelper('test');

        $instance->render();

        $attributes     = $instance->getElement()->getAttributes();
        $expected       = '<span class="badge">test</span>';
        $this->assertSame($expected, (string) $instance);
    }
    
}
