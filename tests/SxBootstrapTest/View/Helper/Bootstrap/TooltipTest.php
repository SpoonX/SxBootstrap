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
    public function testSetOptionError()
    {
        $tooltipHelper = new Tooltip();
        $instance      = $tooltipHelper();
        $instance->setOption('invalidOption', 'test');
    }
    
    public function testSetOptions()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper  = new Tooltip();
        $instance       = $tooltipHelper();
        $instance->setOptions(array(
            'container' => 'test',
            'animation' => 'test2'
        ));
        
        $expected = '<a data-toggle="tooltip" rel="tooltip" data-container="test" data-animation="test2"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testSetOptionBool()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper  = new Tooltip();
        $instance       = $tooltipHelper();
        $instance->setOption('container', true);
        
        $expected = '<a data-toggle="tooltip" rel="tooltip" data-container="true"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetOptionsErrorArray()
    {
        $tooltipHelper  = new Tooltip();
        $instance       = $tooltipHelper();
        $instance->setOptions('invalidOption');
    }
    
    public function testSetHref()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setHref('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" href="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testSetTrigger()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setTrigger('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-trigger="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testSetPlacement()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setPlacement('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-placement="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }

    public function testSetSelector()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setSelector('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-selector="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testSetDefaultTitle()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setDefaultTitle('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" data-title="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
    
    public function testSetTitle()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Tooltip */
        $tooltipHelper = new Tooltip();
        $instance    = $tooltipHelper();
        $instance->setTitle('test');
        
        $expected    = '<a data-toggle="tooltip" rel="tooltip" title="test"></a>';

        $this->assertSame($expected, (string) $instance);
    }
}
