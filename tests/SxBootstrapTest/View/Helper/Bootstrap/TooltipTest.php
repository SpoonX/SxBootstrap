<?php

namespace SxBootstrapTest\View\Helper\Bootstrap;

use PHPUnit_Framework_TestCase;
use SxBootstrap\View\Helper\Bootstrap\Tooltip;

/**
 * @covers SxBootstrap\View\Helper\Bootstrap\Tooltip
 */
class TooltipTest extends PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $attributes  = $instance->getElement()->getAttributes();
        $expected    = '<a data-toggle="tooltip" rel="tooltip"></a>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Tooltip', $instance);
        $this->assertSame('tooltip', $attributes['data-toggle']);
        $this->assertSame('tooltip', $attributes['rel']);
        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeMessage()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper('test', 'test', 'test');
        $expected    = '<a data-toggle="tooltip" rel="tooltip" title="test" href="test">test</a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeSetOption()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setOption('container', 'test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-container="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvokeSetOptionError()
    {
        /* @var Exception\InvalidArgumentException */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setOption('invalidOption', 'test');
    }
    
    public function testInvokeSetHref()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setHref('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" href="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeSetTrigger()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setTrigger('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-trigger="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeSetPlacement()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setPlacement('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-placement="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }

    public function testInvokeSetSelector()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setSelector('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-selector="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeSetDefaultTitle()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setDefaultTitle('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-title="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeSetTitle()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setTitle('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" title="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
}
