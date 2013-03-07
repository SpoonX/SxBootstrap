<?php

namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Html\HtmlElement;
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
    const SCROLL_STYLE_ALL     = 'All';

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
     * Return the HTML string of this HTML element
     *
     * @return string
     */
    public function render()
    {
        $urlHelper      = $this->getView()->plugin('url');
        $paginationData = $this->paginator->getPages($this->scrollingStyle);
        $unorderedList  = $this->getElement()->spawnChild('ul');
        $previous       = $unorderedList->spawnChild('li');
        $previousAnchor = $previous->spawnChild('a')->setContent('&laquo;');

        if (empty($paginationData->previous)) {
            $previous->addClass('disabled');
        } else {
            $previousAnchor->addAttribute('href', $urlHelper(null, array('page' => $paginationData->previous)));
        }

        foreach ($paginationData->pagesInRange as $page) {
            $pageNumberElement = $unorderedList->spawnChild('li');
            $pageHref          = $urlHelper(null, array('page' => $page));

            if ($page === $paginationData->current) {
                $pageNumberElement->addClass('active');
            }

            $pageNumberElement->spawnChild('a')->addAttribute('href', $pageHref)->setContent($page);
        }

        $next       = $unorderedList->spawnChild('li');
        $nextAnchor = $next->spawnChild('a')->setContent('&raquo;');

        if (empty($paginationData->next)) {
            $next->addClass('disabled');
        } else {
            $nextAnchor->addAttribute('href', $urlHelper(null, array('page' => $paginationData->next)));
        }

        return $this->getElement()->render();
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
