<?php

/**
 * Tooltip
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */

namespace SxBootstrap\View\Helper\Bootstrap;

use SxBootstrap\Exception;
use SxCore\Html\HtmlElement;

/**
 * Tooltip
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_View
 * @subpackage Helper
 */
class Tooltip extends AbstractElementHelper
{

    /**
     * Available options for the tooltip
     *
     * @var array
     */
    protected $availableOptions = array(
        'animation',
        'html',
        'placement',
        'selector',
        'title',
        'trigger',
        'delay',
        'container',
    );

    /**
     * Display the tooltip title
     *
     * @param string $title
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Tooltip
     */
    public function setTitle($title)
    {
        $this->getElement()->addAttribute('title', $title);

        return $this;
    }

    /**
     * Set the default title for when the title attribute is not present
     *
     * @param string $title
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Tooltip
     */
    public function setDefaultTitle($title)
    {
        return $this->setOption('title', $title);
    }

    /**
     * Set the selector.
     * All elements that are effected by this selector will get this tooltip.
     *
     * @param string $selector
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Tooltip
     */
    public function setSelector($selector)
    {
        return $this->setOption('selector', $selector);
    }

    /**
     * Set the placement
     *
     * @param string $placement
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Tooltip
     */
    public function setPlacement($placement)
    {
        return $this->setOption('placement', $placement);
    }

    /**
     * Set the trigger
     *
     * @param string $trigger
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Tooltip
     */
    public function setTrigger($trigger)
    {
        return $this->setOption('trigger', $trigger);
    }

    /**
     * Set the href
     *
     * @param string $href
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Tooltip
     */
    public function setHref($href)
    {
        $this->getElement()->addAttribute('href', $href);

        return $this;
    }

    /**
     * Set the tooltip options
     *
     * @param   array
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Tooltip
     * @throws Exception\InvalidArgumentException
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $this->setOption($key, $value);
        }

        return $this;
    }

    /**
     * Set a single option to the Tooltip
     *
     * @param string $key
     * @param string $value
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     * @throws Exception\InvalidArgumentException
     */
    public function setOption($key, $value)
    {
        if (!in_array($key, $this->availableOptions)) {
            throw new Exception\InvalidArgumentException('Invalid option for Tooltip');
        }

        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        if (!is_string($value)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Invalid value for Tooltip, expected boolean or string, got "%s"',
                gettype($value)
            ));
        }

        $this->getElement()->addAttribute("data-$key", $value);

        return $this;
    }

    /**
     * Invoke Tooltip
     *
     * @param string $title
     * @param string $content
     * @param string $href
     *
     * @return \SxBootstrap\View\Helper\Bootstrap\Label
     */
    public function __invoke($title = null, $content = null, $href = null)
    {
        $element = new HtmlElement('a');

        $element->addAttributes(array(
            'data-toggle' => 'tooltip',
            'rel'         => 'tooltip',
        ));

        $this->setElement($element);

        if (!is_null($title)) {
            $this->setTitle($title);
        }

        if (!is_null($content)) {
            $this->setContent($content);
        }

        if (!is_null($href)) {
            $this->setHref($href);
        }

        return clone $this;
    }
}
