<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;
use Zend\Paginator\Paginator;

/**
 * The ViewHelper that creates a pager.
 */
class Pager extends AbstractElementHelper
{

    /**
     * @var \Zend\Paginator\Paginator
     */
    protected $paginator;

    /**
     * @var bool
     */
    protected $align = false;

    /**
     * @var string
     */
    protected $prevLabel = '&larr; Previous';

    /**
     * @var string
     */
    protected $nextLabel = 'Next &rarr;';

    /**
     * @var array
     */
    protected $routeParams = array();

    /**
     * @var string|null
     */
    protected $route = null;

    /**
     * @var array
     */
    protected $listAttributes = array();

    /**
     * @var array
     */
    protected $previousAttributes = array();

    /**
     * @var array
     */
    protected $nextAttributes = array();

    /**
     * @param array $listAttributes
     *
     * @return self
     */
    public function setListAttributes($listAttributes)
    {
        $this->listAttributes = $listAttributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getListAttributes()
    {
        return $this->listAttributes;
    }

    /**
     * @param array $previousAttributes
     *
     * @return self
     */
    public function setPreviousAttributes($previousAttributes)
    {
        $this->previousAttributes = $previousAttributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getPreviousAttributes()
    {
        return $this->previousAttributes;
    }

    /**
     * @param array $nextAttributes
     *
     * @return self
     */
    public function setNextAttributes($nextAttributes)
    {
        $this->nextAttributes = $nextAttributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getNextAttributes()
    {
        return $this->nextAttributes;
    }

    /**
     * @param \Zend\Paginator\Paginator $paginator
     *
     * @return Pagination
     */
    public function __invoke(Paginator $paginator)
    {
        $pagerElement = new HtmlElement('ul');

        $pagerElement->addClass('pager');
        $this->setPaginator($paginator);
        $this->setElement($pagerElement);

        return clone $this;
    }

    /**
     * Return the HTML string of this HTML element
     *
     * @return string
     */
    public function render()
    {
        $paginationData = $this->paginator->getPages();
        $previous       = $this->getElement()->spawnChild('li');
        $next           = $this->getElement()->spawnChild('li');
        $previousAnchor = $previous->spawnChild('a')->setContent($this->getPrevLabel());
        $nextAnchor     = $next->spawnChild('a')->setContent($this->getNextLabel());

        $this->getElement()->addAttributes($this->getListAttributes());

        $previousAnchor->setAttributes($this->getPreviousAttributes());
        $nextAnchor->setAttributes($this->getNextAttributes());

        if (empty($paginationData->previous)) {
            $previous->addClass('disabled');
        } else {
            $previousAnchor->addAttribute('data-page', $paginationData->previous);
            $previousAnchor->addAttribute('href', $this->getUrl(
                $this->getRoute(),
                array_merge(
                    array('page' => $paginationData->previous),
                    $this->getRouteParams()
                )
            ));
        }

        if (empty($paginationData->next)) {
            $next->addClass('disabled');
        } else {
            $nextAnchor->addAttribute('data-page', $paginationData->next);
            $nextAnchor->addAttribute('href', $this->getUrl(
                $this->getRoute(),
                array_merge(
                    array('page' => $paginationData->next),
                    $this->getRouteParams()
                )
            ));
        }

        if ($this->align) {
            $previous->addClass('previous');
            $next->addClass('next');
        }

        return $this->getElement()->render();
    }

    /**
     * @param string $route
     *
     * @return self
     */
    public function setRoute($route)
    {
        $this->route = (string) $route;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @param array  $params
     *
     * @return string
     */
    protected function getUrl($route, $params = array())
    {
        $urlHelper = $this->getView()->plugin('url');

        if ('#' === $route[0]) {
            return $route;
        }

        return $urlHelper($route, $params);
    }

    /**
     * @param array $routeParams
     *
     * @return self
     */
    public function setRouteParams(array $routeParams)
    {
        $this->routeParams = $routeParams;

        return $this;
    }

    /**
     * @return array
     */
    public function getRouteParams()
    {
        return $this->routeParams;
    }

    /**
     * @param $nextLabel
     *
     * @return self
     */
    public function setNextLabel($nextLabel)
    {
        $this->nextLabel = $nextLabel;

        return $this;
    }

    /**
     * @return string
     */
    public function getNextLabel()
    {
        return $this->translateLabel($this->nextLabel);
    }

    /**
     * @param $prevLabel
     *
     * @return self
     */
    public function setPrevLabel($prevLabel)
    {
        $this->prevLabel = $prevLabel;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrevLabel()
    {
        return $this->translateLabel($this->prevLabel);
    }

    /**
     * @param $label
     *
     * @return string
     */
    protected function translateLabel($label)
    {
        if (null !== ($translator = $this->getTranslator())) {
            $label = $translator->translate(
                $label, $this->getTranslatorTextDomain()
            );
        }

        return $label;
    }

    /**
     * @param \Zend\Paginator\Paginator $paginator
     *
     * @return Pagination
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;

        return $this;
    }

    /**
     * align each link to the sides
     *
     * @param bool $align
     *
     * @return self
     */
    public function align($align = true)
    {
        $this->align = (bool) $align;

        return $this;
    }

}
