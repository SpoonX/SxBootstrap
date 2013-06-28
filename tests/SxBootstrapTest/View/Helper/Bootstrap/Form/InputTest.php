<?php
/**
 * @author  RWOverdijk
 * @package InputTest
 */

namespace SxBootstrapTest\View\Helper\Bootstrap\Form;

use SxBootstrap\View\Helper\Bootstrap\Form\Input;
use Zend\Form\Element\Text;

class InputTest extends \PHPUnit_Framework_TestCase
{

    protected $phpRenderer;

    protected $doctypeHelper;

    public function setUp()
    {
        $doctypeHelperMock = $this->getMock('Zend\View\Helper\Doctype');
        $phpRendererMock   = $this->getMock('Zend\View\Renderer\PhpRenderer');

        $doctypeHelperMock
            ->expects($this->any())
            ->method('isXhtml')
            ->will($this->returnValue(false));

        $phpRendererMock
            ->expects($this->any())
            ->method('plugin')
            ->with('doctype')
            ->will($this->returnValue($doctypeHelperMock));

        $this->phpRenderer   = $phpRendererMock;
        $this->doctypeHelper = $doctypeHelperMock;
    }

    public function testInvokeType()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper('bacon');

        // Need to test if invoke returns what we expect.
        $this->assertInstanceOf('\SxBootstrap\View\Helper\Bootstrap\Form\Input', $helper);

        $helper->setView($this->phpRenderer);
        $this->assertSame('<input type="bacon">', (string) $helper);
    }

    public function testInvokeTypeXhtml()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper('bacon');

        $doctypeHelperMock = $this->getMock('Zend\View\Helper\Doctype');
        $phpRendererMock   = $this->getMock('Zend\View\Renderer\PhpRenderer');

        $doctypeHelperMock
            ->expects($this->once())
            ->method('isXhtml')
            ->will($this->returnValue(true));

        $phpRendererMock
            ->expects($this->once())
            ->method('plugin')
            ->with('doctype')
            ->will($this->returnValue($doctypeHelperMock));

        $helper->setView($phpRendererMock);
        $this->assertSame('<input type="bacon" />', (string) $helper);
    }

    public function testInvokeFormElement()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $element = new Text('Bacon');
        $helper  = new Input();
        $helper  = $helper($element);

        $helper->setView($this->phpRenderer);
        $this->assertSame('<input name="Bacon" type="text" value="">', $helper->render());
    }

    public function testPlaceholder()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper      = new Input();
        $helper      = $helper('bacon');
        $placeholder = 'Foo bar baz...';

        $helper->placeholder($placeholder);

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue(isset($attributes['placeholder']));
        $this->assertSame($placeholder, $attributes['placeholder']);

        $helper->setView($this->phpRenderer);
        $this->assertSame('<input type="bacon" placeholder="' . $placeholder . '">', $helper->render());
    }

    public function testType()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();
        $type   = 'bacon';

        $helper->type($type);

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue(isset($attributes['type']));
        $this->assertSame($type, $attributes['type']);

        $helper->setView($this->phpRenderer);
        $this->assertSame('<input type="' . $type . '">', $helper->render());
    }

    public function testValue()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();
        $value  = 'bacon';

        $helper->value($value);

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue(isset($attributes['value']));
        $this->assertSame($value, $attributes['value']);

        $helper->setView($this->phpRenderer);
        $this->assertSame('<input value="' . $value . '">', $helper->render());
    }

    public function testName()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();
        $name   = 'bacon';

        $helper->name($name);

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue(isset($attributes['name']));
        $this->assertSame($name, $attributes['name']);

        $helper->setView($this->phpRenderer);
        $this->assertSame('<input name="' . $name . '">', $helper->render());
    }

    public function testMini()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();

        $helper->mini();

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue((bool) strstr('input-mini', $attributes['class']));
    }

    public function testSmall()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();

        $helper->small();

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue((bool) strstr('input-small', $attributes['class']));
    }

    public function testMedium()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();

        $helper->medium();

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue((bool) strstr('input-medium', $attributes['class']));
    }

    public function testLarge()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();

        $helper->large();

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue((bool) strstr('input-large', $attributes['class']));
    }

    public function testXLarge()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();

        $helper->xlarge();

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue((bool) strstr('input-xlarge', $attributes['class']));
    }

    public function testXxLarge()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();

        $helper->xxlarge();

        $attributes = $helper->getElement()->getAttributes();

        $this->assertTrue((bool) strstr('input-xxlarge', $attributes['class']));
    }

    public function testRender()
    {
        /* @var $helper \SxBootstrap\View\Helper\Bootstrap\Form\Input */
        $helper = new Input();
        $helper = $helper();

        $helper->setView($this->phpRenderer);
        $this->assertSame('<input>', $helper->render());
    }
}
