<?php
/**
 * Navigation
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Exception;
use Zend\View\Helper\AbstractHtmlElement;
use Zend\Dom\Query;

class NavigationMenu extends AbstractHtmlElement
{
    /**
     * Render a default menu.
     *
     * @param string|\SpiffyNavigation\Container|null $container
     * @param array $options
     *
     * @return string
     */
    public function renderMenu($container = null, array $options = array())
    {
        return $this->getView()->navigationMenu()->renderMenu($container, $options);
    }

    /**
     * @param null $container
     * @param array $options
     *
     * @return string
     */
    public function renderDropDownMenu($container = null, array $options = array())
    {
        $menu = $this->getView()->navigationMenu()->renderMenu($container, $options);
        $query = new Query($menu);
        $uls = $query->execute('li>ul');
        $caret = $uls->getDocument()->createDocumentFragment();
        $caret->appendXML('<b class="caret" />');

        /** @var \DOMElement $ul */
        foreach ($uls as $key => $ul) {
            $index = $key+1;

            $this->addCss('dropdown-menu', $ul);
            $ul->setAttribute('role', 'menu');
            $ul->setAttribute('aria-labelledby', "drop{$index}");

            $li = $ul->parentNode;
            $this->addCss('dropdown', $li);

            $a = $li->firstChild;
            $this->addCss('dropdown-toggle', $a);
            $a->setAttribute('role', 'button');
            $a->setAttribute('data-toggle', 'dropdown');
            $a->setAttribute('href', '#');
            $a->setAttribute('id', "drop{$index}");
            $a->appendChild($caret);
        }

        return preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $uls->getDocument()->saveHTML());
    }

    /**
     * @param $css
     * @param \DOMElement $el
     *
     * @return \DOMElement
     */
    protected function addCss($css, \DOMElement $el)
    {
        $el->setAttribute(
            'class',
            $el->getAttribute('class')
            ? $el->getAttribute('class') . ' ' . $css
            : $css
        );

        return $el;
    }

    public function renderPartial($container = null, $partial = null)
    {
        return $this->getView()->renderPartial($container, $partial);
    }
}
