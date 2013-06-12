<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxCore\Html\HtmlElement;
use Zend\Paginator\Paginator;

/**
 * The ViewHelper that creates pagination.
 */
class Pagination extends AbstractElementHelper
{

    /**
     * Returns every page. This is useful for dropdown menu pagination controls with relatively few pages.
     * In these cases, you want all pages available to the user at once.
     */
    const SCROLL_STYLE_ALL = 'All';

    /**
     * A Google-like scrolling style that expands and contracts as a user scrolls through the pages.
     */
    const SCROLL_STYLE_ELASTIC = 'Elastic';

    /**
     * As users scroll through, the page number advances to the end of a given range, then starts again at the beginning of the new range.
     */
    const SCROLL_STYLE_JUMPING = 'Jumping';

    /**
     * A Yahoo!-like scrolling style that positions the current page number in the center of the page range, or as close as possible.
     * This is the default style.
     */
    const SCROLL_STYLE_SLIDING = 'Sliding';

    /**
     * @var string
     */
    protected $scrollingStyle = self::SCROLL_STYLE_SLIDING;

    /**
     * @var \Zend\Paginator\Paginator
     */
    protected $paginator;

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
    protected $listItemAttributes = array();

    /**
     * @var array
     */
    protected $previousAttributes = array();

    /**
     * @var array
     */
    protected $nextAttributes = array();

    /**
     * @var array
     */
    protected $anchorAttributes = array();

    /**
     * @param array $anchorAttributes
     *
     * @return $this Pagination
     */
    public function setAnchorAttributes($anchorAttributes)
    {
        $this->anchorAttributes = $anchorAttributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getAnchorAttributes()
    {
        return $this->anchorAttributes;
    }

    /**
     * @param array $listAttributes
     *
     * @return $this Pagination
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
     * @param array $listItemAttributes
     *
     * @return $this Pagination
     */
    public function setListItemAttributes($listItemAttributes)
    {
        $this->listItemAttributes = $listItemAttributes;

        return $this;
    }

    /**
     * @return array
     */
    public function getListItemAttributes()
    {
        return $this->listItemAttributes;
    }

    /**
     * @param array $previousAttributes
     *
     * @return $this Pagination
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
     * @return $this Pagination
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
        $paginationElement = new HtmlElement;

        $paginationElement->addClass('pagination');
        $this->setPaginator($paginator);
        $this->setElement($paginationElement);

        return clone $this;
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
     * Return the HTML string of this HTML element
     *
     * @return string
     */
    public function render()
    {
        $paginationData = $this->paginator->getPages($this->scrollingStyle);
        $unorderedList  = $this->getElement()->spawnChild('ul');
        $previous       = $unorderedList->spawnChild('li');
        $previousAnchor = $previous->spawnChild('a')->setContent('&laquo;');

        $unorderedList->setAttributes($this->getListAttributes());
        $previous->setAttributes($this->getListItemAttributes());
        $previous->addAttributes($this->getPreviousAttributes());
        $previousAnchor->setAttributes($this->getAnchorAttributes());

        if (empty($paginationData->previous)) {
            $previous->addClass('disabled');
        } else {
            $previousAnchor->addAttribute('href', $this->getUrl(
                $this->getRoute(),
                array_merge(
                    array('page' => $paginationData->previous),
                    $this->getRouteParams()
                )
            ));
        }

        foreach ($paginationData->pagesInRange as $page) {
            $pageNumberElement = $unorderedList->spawnChild('li');
            $pageHref          = $this->getUrl(
                $this->getRoute(),
                array_merge(
                    array('page' => $page),
                    $this->getRouteParams()
                )
            );

            $pageNumberElement->setAttributes($this->getListItemAttributes());

            if ($page === $paginationData->current) {
                $pageNumberElement->addClass('active');
            }

            $anchorElement = $pageNumberElement->spawnChild('a')->addAttribute('href', $pageHref)->setContent($page);

            $anchorElement->addAttribute('data-page', $page);
        }

        $next       = $unorderedList->spawnChild('li');
        $nextAnchor = $next->spawnChild('a')->setContent('&raquo;');

        $next->setAttributes($this->getNextAttributes());

        if (empty($paginationData->next)) {
            $next->addClass('disabled');
        } else {
            $nextAnchor->addAttribute('href', $this->getUrl(
                $this->getRoute(),
                array_merge(
                    array('page' => $paginationData->next),
                    $this->getRouteParams()
                )
            ));
        }

        return $this->getElement()->render();
    }

    /**
     * @param string $route
     *
     * @return Pagination
     */
    public function setRoute($route)
    {
        $this->route = (string)$route;

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
     * @param array $routeParams
     *
     * @return Pagination
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
     * Render the pagination LARGE
     *
     * @return AbstractElementHelper
     */
    public function large()
    {
        return $this->addClass('pagination-large');
    }

    /**
     * Render the pagination small
     *
     * @return AbstractElementHelper
     */
    public function small()
    {
        return $this->addClass('pagination-small');
    }

    /**
     * Render the pagination smallest
     *
     * @return AbstractElementHelper
     */
    public function mini()
    {
        return $this->addClass('pagination-mini');
    }

    /**
     * Align the pagination in the center.
     *
     * @return AbstractElementHelper
     */
    public function centered()
    {
        return $this->addClass('pagination-centered');
    }

    /**
     * Align the pagination to the right.
     *
     * @return AbstractElementHelper
     */
    public function right()
    {
        return $this->addClass('pagination-right');
    }

    /**
     * Set scroll style elastic
     *
     * @return Pagination
     */
    public function elastic()
    {
        $this->scrollingStyle = self::SCROLL_STYLE_ELASTIC;

        return $this;
    }

    /**
     * Set scroll style jumping
     *
     * @return Pagination
     */
    public function jumping()
    {
        $this->scrollingStyle = self::SCROLL_STYLE_JUMPING;

        return $this;
    }

    /**
     * Set scroll style sliding
     *
     * @return Pagination
     */
    public function sliding()
    {
        $this->scrollingStyle = self::SCROLL_STYLE_SLIDING;

        return $this;
    }

    /**
     * Set scroll style all
     *
     * @return Pagination
     */
    public function all()
    {
        $this->scrollingStyle = self::SCROLL_STYLE_ALL;

        return $this;
    }

}
