<?php

namespace SxBootstrapTest\View\Helper\Bootstrap;

use PHPUnit_Framework_TestCase;
use SxBootstrap\View\Helper\Bootstrap\Label;

/**
 * @covers SxBootstrap\View\Helper\Bootstrap\Label
 */
class LabelTest extends PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Label */
        $labelHelper = new Label();
        $instance    = $labelHelper();
        $attributes  = $instance->getElement()->getAttributes();
        $expected    = '<span class="label"></span>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Label', $instance);
        $this->assertSame('label', $attributes['class']);
        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInvokeMessage()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Label */
        $labelHelper = new Label();
        $instance    = $labelHelper('test');
        $expected    = '<span class="label">test</span>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Label', $instance);
        $this->assertSame($expected, (string) $instance);
    }
    
    public function testInfo()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Label */
        $labeltHelper   = new Label();
        $instance       = $labeltHelper('test');

        $instance->info();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('label label-info', $attributes['class']);
    }

    public function testImportant()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Label */
        $labeltHelper   = new Label();
        $instance       = $labeltHelper('test');

        $instance->important();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('label label-important', $attributes['class']);
    }
    
    public function testInverse()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Label */
        $labeltHelper   = new Label();
        $instance       = $labeltHelper('test');

        $instance->inverse();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('label label-inverse', $attributes['class']);
    }
    
    public function testSuccess()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Label */
        $labeltHelper   = new Label();
        $instance       = $labeltHelper('test');

        $instance->success();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('label label-success', $attributes['class']);
    }    
    
    public function testWarning()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Label */
        $labeltHelper   = new Label();
        $instance       = $labeltHelper('test');

        $instance->warning();

        $attributes     = $instance->getElement()->getAttributes();

        $this->assertSame('label label-warning', $attributes['class']);
    }
    
    public function testRender()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Well */
        $labeltHelper   = new Label();
        $instance       = $labeltHelper('test');

        $instance->render();

        $attributes     = $instance->getElement()->getAttributes();
        $expected       = '<span class="label">test</span>';
        $this->assertSame($expected, (string) $instance);
    }
    
}
