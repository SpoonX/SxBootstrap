<?php

/**
 * SxBootstrap
 *
 * @category   SxBootstrap
 * @package    SxBootstrap_Html
 */
namespace SxBootstrap\Html;

class HtmlElement
{

    /**
     * The tag to render
     *
     * @var string
     */
    protected $tag;

    /**
     * The children of the tag
     *
     * @var array
     */
    protected $children = array();

    /**
     * The attributes of the tag
     *
     * @var array
     */
    protected $attributes = array();

    /**
     * The content of the tag
     *
     * @var string|null
     */
    protected $content;

    /**
     * Append, or prepend set content next to rendered children
     *
     * @var     string  prepend|append
     */
    protected $contentConcat = 'prepend';

    /**
     * Contruct tag
     *
     * @var     string  Tagname (Allowed tags are html tags, div, span, a etc)
     */
    public function __construct($tag = 'div')
    {
        $this->tag = $tag;
    }

    /**
     * Set position of content to append
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function setAppendContent()
    {
        $this->contentConcat = 'append';

        return $this;
    }

    /**
     * Set position of content to prepend
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function setPrependContent()
    {
        $this->contentConcat = 'prepend';

        return $this;
    }

    /**
     * Set tag attributes
     *
     * @var     array
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add tag attributes
     *
     * @var     array
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     *
     * @param   string  $key
     * @param   string  $value
     *
     * @return  \SxBootstrap\Html\HtmlElement
     *
     * @throws  \SxBootstrapException\InvalidArgumentException
     */
    public function addAttribute($key, $value)
    {
        if (!is_string($key) || (!is_string($value)) && !is_numeric($value)) {
            throw new Exception\InvalidArgumentException(
            'Invalid key or value type supplied. Expected string.'
            );
        }

        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Remove tag attributes
     *
     * @var     string  $key
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function removeAttribute($key)
    {
        if (!empty($this->attributes[$key])) {
            unset($this->attributes[$key]);
        }

        return $this;
    }

    /**
     * Get tag attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Add class to tag
     *
     * @var     string  $class
     *
     * @return  string
     */
    public function addClass($class)
    {
        if (!empty($this->attributes['class'])) {
            $class = $this->attributes['class'] . " $class";
        }

        return $this->addAttribute('class', $class);
    }

    /**
     * Set tag content
     *
     * @var     string  $content
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Append content before other content
     *
     * @var     string  $content
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function appendContent($content)
    {
        $this->content .= $content;

        return $this;
    }

    /**
     * Prepend content after other content
     *
     * @var     string  $content
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function prependContent($content)
    {
        $this->content = $content . $this->content;

        return $this;
    }

    /**
     * Remove content
     *
     * @return \SxBootstrap\Html\HtmlElement
     */
    public function removeContent()
    {
        $this->content = null;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        if (null === $this->content) {
            return '';
        }

        return $this->content;
    }

    /**
     * Spawn child
     *
     * @var     string  $tag
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function spawnChild($tag = null)
    {
        return $this->children[] = new self($tag);
    }

    /**
     * Add child to tag
     *
     * @var     \SxBootstrap\Html\HtmlElement
     *
     * @return  \SxBootstrap\Html\HtmlElement
     */
    public function addChild(self $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Add children to tag
     *
     * @var     array
     *
     * @return  \SxBootstrap\Html
     */
    public function addChildren(array $children)
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }

        return $this;
    }

    /**
     * Remove childeren
     *
     * @return  \SxBootstrap\Html
     */
    public function removeChildren()
    {
        $this->children = array();

        return $this;
    }

    /**
     * Set childrden
     *
     * @var     array
     *
     * @return  \SxBootstrap\Html
     */
    public function setChildren(array $children)
    {
        $this->removeChildren();

        return $this->addChildren($children);
    }

    /**
     * Check for children
     *
     * @return  bool
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }

    /**
     * Render content
     *
     * @return  string
     */
    public function render()
    {
        $content = '';

        if ($this->hasChildren()) {
            $content = $this->renderChildren($this->children);
        }

        if ('append' === $this->contentConcat) {
            $content .= $this->getContent();
        } else {
            $content = $this->getContent() . $content;
        }

        return $this->getTag($content);
    }

    /**
     * Render tag
     *
     * @var     string  $content
     *
     * @return  string
     */
    protected function getTag($content)
    {
        $attributes = $this->renderAttributes();

        return sprintf(
                '<%1$s%2$s>%3$s</%1$s>', $this->tag, $attributes, $content
        );
    }

    /**
     * Render tag attributes
     *
     * @return      string
     */
    protected function renderAttributes()
    {
        $attributes = '';

        foreach ($this->attributes as $key => $value) {
            $attributes .= " $key=\"$value\"";
        }

        return $attributes;
    }

    /**
     * Render data
     *
     * @return string
     */
    protected function renderData()
    {
        $data = '';

        foreach ($this->data as $value) {
            $data .= " data=\"$value\""; // iets hier..
        }

        return $data;
    }

    /**
     * Render children
     *
     * @return string
     */
    protected function renderChildren(array $children)
    {
        $content = '';

        foreach ($children as $child) {
            $content .= $child->render();
        }

        return $content;
    }

    /**
     * Output tag
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

}
