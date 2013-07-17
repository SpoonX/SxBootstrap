<?php

namespace SxBootstrapTest\View\Helper\Bootstrap;

use PHPUnit_Framework_TestCase as TestCase;
use SxBootstrap\View\Helper\Bootstrap\NavigationMenu;
use SpiffyNavigation\ContainerFactory;
use SpiffyNavigation\Page\PageFactory;
use SpiffyNavigation\Service\Navigation;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Renderer\PhpRenderer;

/**
 * @covers SxBootstrap\View\Helper\Bootstrap\NavigationMenu
 */
class NavigationMenuTest extends TestCase
{
	/**
     * @var \SpiffyNavigation\View\Helper\AbstractHelper
     */
    protected $helper;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

	/**
	 * Standard setUp
	 */
	public function setUp()
	{
		$nav = $this->getMockBuilder('SpiffyNavigation\Service\Navigation')
                     ->disableOriginalConstructor()
                     ->getMock();
					 
		$this->helper = new NavigationMenu($nav);
		$this->helper->setView(new PhpRenderer());
					 
		$smConfig = array(
            'modules'                 => array(),
            'module_listener_options' => array(
                'config_cache_enabled' => false,
                'cache_dir'            => 'data/cache',
            ),
        );

        $sm = $this->serviceManager = new ServiceManager(new ServiceManagerConfig());
        $sm->setService('ApplicationConfig', $smConfig);
        $sm->get('ModuleManager')->loadModules();
        $sm->get('Application')->bootstrap();

        $sm->setAllowOverride(true);
	}
	
	/**
	 * Just a proxy to SpiffyNavigation\View\Helper\NavigationMenu::renderMenu();
	 * So this is simply for code coverage.
	 *
	 * @test
	 */
	public function renderMenu()
	{
		$spiffyNavStub = $this->getMockBuilder('SpiffyNavigation\View\Helper\NavigationMenu')
                     ->disableOriginalConstructor()
                     ->getMock();
 
        $spiffyNavStub->expects($this->any())
             ->method('renderMenu')
             ->will($this->returnValue('<info>testing only code coverage here</info>'));
			 
		$this->serviceManager->setAllowOverride(true);
		$this->serviceManager->setService('navigationMenu', $spiffyNavStub);

		$service = $this->serviceManager->get('navigationMenu');

		$this->assertEquals(
			'<info>testing only code coverage here</info>',
			$this->helper->setNavigationMenu($spiffyNavStub)->renderMenu('test')
		);
	}
	
	/**
	 * Issue #80
	 *
	 * @test
	 */
	public function renderDropDownMenu()
	{
		$spiffyNavStub = $this->getMockBuilder('SpiffyNavigation\View\Helper\NavigationMenu')
            ->disableOriginalConstructor()
            ->getMock();
 
        $spiffyNavStub->expects($this->any())
            ->method('renderMenu')
            ->will($this->returnValue(
		        '<ul><li><ul><li>one</li><li>two</li></ul></li><li><ul><li>one</li><li>two</li></ul></li></ul>'
		    )
		);
		 
		$this->serviceManager->setAllowOverride(true);
		$this->serviceManager->setService('navigationMenu', $spiffyNavStub);

		$service = $this->serviceManager->get('navigationMenu');
		
		try {
			$this->helper->setNavigationMenu($spiffyNavStub)->renderDropDownMenu('test');
		} catch (\PHPUnit_Framework_Error_Warning $e) {
		    $this->fail($e->getMessage());
		}
		
		$this->assertContains(
			'<b class="caret"></b>',
			$this->helper->setNavigationMenu($spiffyNavStub)->renderDropDownMenu('test')
		);
	}
	
	/**
	 * add css
	 *
	 * @test
	 */
    public function addCss()
    {
		$menu = new NavigationMenu();
		
        $reflectionClass = new \ReflectionClass($menu);
        $addCss = $reflectionClass->getMethod('addCss');
        $addCss->setAccessible(true);

		$doc = new \DOMDocument;
		$doc->loadHTML('<span id="dropdown">Foo</span>');
		$doc->appendChild($addCss->invoke($menu, 'dropdown-menu', $doc->getElementById('dropdown')));
		
		$this->assertContains('<span id="dropdown" class="dropdown-menu">Foo</span>', $doc->saveXML());
    }
}
