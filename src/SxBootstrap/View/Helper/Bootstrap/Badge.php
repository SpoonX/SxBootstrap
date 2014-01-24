<?php
/**
 * Badge
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Exception;
use SxCore\Html\HtmlElement;

/**
 * Badge
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Badge extends AbstractElementHelper
{

    /**
     * Invoke Badge
     *
     * @param string $badge
     *
     * @return Badge
     * @throws Exception\InvalidArgumentException
     */
    public function __invoke($badge)
    {
        if (!is_string($badge)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Badge must be of type string, got "%s".',
                gettype($badge)
            ));
        }

        $this->setElement(new HtmlElement('span'))->addClass('badge');

        return clone $this->setContent($badge);
    }
}
