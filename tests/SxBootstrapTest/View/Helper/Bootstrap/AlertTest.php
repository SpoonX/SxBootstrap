<?php

namespace SxBootstrapTest\View\Helper\Bootstrap;

use PHPUnit_Framework_TestCase;
use SxBootstrap\View\Helper\Bootstrap\Alert;

/**
 * @covers SxBootstrap\View\Helper\Bootstrap\Alert
 */
class AlertTest extends PHPUnit_Framework_TestCase
{

    /**
     * Also tests createDismissButton
     */
    public function testInvokeDefault()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper();
        $attributes  = $instance->getElement()->getAttributes();
        $expected    = '<div class="alert"><button data-dismiss="alert" type="button" class="close">&times;</button></div>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Alert', $instance);
        $this->assertSame('alert', $attributes['class']);
        $this->assertSame($expected, (string) $instance);
    }

    /**
     * Also tests render
     */
    public function testInvokeMessage()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper('Bacon train');
        $expected    = '<div class="alert"><button data-dismiss="alert" type="button" class="close">&times;</button>Bacon train</div>';

        $this->assertSame($expected, $instance->render());
    }

    public function testInvokeMessageBlock()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper('Bacon Makin', true);
        $expected    = '<div class="alert alert-block"><button data-dismiss="alert" type="button" class="close">&times;</button>Bacon Makin</div>';

        $this->assertSame($expected, (string) $instance);
    }

    public function testInfo()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper();

        $instance->info();

        $attributes = $instance->getElement()->getAttributes();

        $this->assertSame('alert alert-info', $attributes['class']);
    }

    public function testError()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper();

        $instance->error();

        $attributes = $instance->getElement()->getAttributes();

        $this->assertSame('alert alert-error', $attributes['class']);
    }

    public function testSuccess()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper();

        $instance->success();

        $attributes = $instance->getElement()->getAttributes();

        $this->assertSame('alert alert-success', $attributes['class']);
    }

    public function testWarning()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper();

        $instance->warning();

        $attributes = $instance->getElement()->getAttributes();

        $this->assertSame('alert alert-warning', $attributes['class']);
    }

    public function testBlock()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper();

        $instance->block();

        $attributes = $instance->getElement()->getAttributes();

        $this->assertSame('alert alert-block', $attributes['class']);
    }

    public function testClosable()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Alert */
        $alertHelper = new Alert();
        $instance    = $alertHelper();

        $this->assertTrue($this->readAttribute($instance, 'closable'));
        $instance->closable(false);
        $this->assertFalse($this->readAttribute($instance, 'closable'));
    }

}
