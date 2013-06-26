<?php

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Color;

class ColorTest extends \PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Color */
        $helper     = new Color();
        $helper     = $helper();
        $attributes = $helper->getElement()->getAttributes();

        $this->assertArrayHasKey('type', $attributes);
        $this->assertSame('color', $attributes['type']);

        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Color', $helper);
    }
}
