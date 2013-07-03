<?php

namespace SxBootstrapTest\View\Helper\Bootstrap;

use PHPUnit_Framework_TestCase;
use SxBootstrap\View\Helper\Bootstrap\Code;

/**
 * @covers SxBootstrap\View\Helper\Bootstrap\Code
 */
class CodeTest extends PHPUnit_Framework_TestCase
{

    public function testInvoke()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Code */
        $codeHelper  = new Code();
        $instance    = $codeHelper();
        $expected    = '<code></code>';

        $this->assertInstanceOf('SxBootstrap\View\Helper\Bootstrap\Code', $instance);
        $this->assertSame($expected, (string) $instance);
    }

    public function testInvokeMessage()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Code */
        $codeHelper  = new Code();
        $instance    = $codeHelper('test tekst');
        $expected    = '<code>test tekst</code>';

        $this->assertSame($expected, (string) $instance);
    }

    public function testInvokeMessageMultiLine()
    {
        /* @var $instance \SxBootstrap\View\Helper\Bootstrap\Code */
        $codeHelper  = new Code();
        $instance    = $codeHelper('test ' ."\n". ' tekst');
        $expected    = '<pre>test ' . PHP_EOL . ' tekst</pre>';

        $this->assertSame($expected, (string) $instance);
    }
}
