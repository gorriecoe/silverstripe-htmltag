<?php

namespace gorriecoe\HTMLTag\View;

use SilverStripe\View\ViewableData;
use SilverStripe\Core\Convert;
use InvalidArgumentException;

/**
 * HTMLTag
 *
 * @package silverstripe-htmltag
 */
class HTMLTag extends ViewableData
{
    /**
     * List of HTML5 void elements
     * @see https://www.w3.org/TR/html51/syntax.html#void-elements
     * @var array
     */
    private static $void_elements = [
        'area' => null,
        'base' => 'href',
        'br' => null,
        'col' => null,
        'embed' => null,
        'hr' => null,
        'img' => 'src',
        'input' => 'value',
        'keygen' => null,
        'link' => 'href',
        'menuitem' => null,
        'meta' => null,
        'param' => null,
        'source' => null,
        'track' => null,
        'wbr' => null
    ];

    /**
     * @var string|null
     */
    protected $string = null;

    /**
     * @var string|null
     */
    protected $tag = null;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $classes = [];

    /**
     * @var string|null
     */
    protected $classPrefix = null;

    public function __construct($string = null, $tag = null)
    {
        $this->string = $string;
        $this->tag = strtolower($tag);
        parent::__construct($string);
    }

    /**
     * Defines a HTML tag type
     * @param string $tag HTML tag type
     * @return HTMLTag $this
     */
    public function setTag($tag)
    {
        $this->tag = strtolower($tag);
        return $this;
    }

    /**
     * Defines an HTML attribute to add
     * @param string $name Attribute name
     * @param string $value Attribute value
     * @return HTMLTag $this
     */
    public function addAttribute($name = null, $value = null)
    {
        if ($value) {
            $this->attributes[$name] = $value;
        }
        return $this;
    }

    /**
     * @alias addAttribute
     */
    public function setAttribute($name = null, $value = null)
    {
        $this->addAttribute($name, $value);
        return $this;
    }

    /**
     * Defines an HTML attribute to remove
     * @param string $name Attribute name
     * @return HTMLTag $this
     */
    public function removeAttribute($name = null)
    {
        unset($this->attributes[$name]);
        return $this;
    }

    /**
     * Defines a CSS classes
     * @param string  $value CSS class
     * @return HTMLTag $this
     */
    public function setID($value)
    {
        $this->setAttribute('id', $value);
        return $this;
    }

    /**
     * Defines CSS classes
     * @param string  $value CSS class
     * @return HTMLTag $this
     */
    public function setClass($value)
    {
        $classes = [];
        foreach (explode(' ', $value) as $class) {
            $classes[$class] = $class;
        }
        $this->classes = $classes;
        return $this;
    }

    /**
     * Defines a CSS classes to add
     * @param string  $value CSS class
     * @return HTMLTag $this
     */
    public function addClass($value)
    {
        foreach (explode(' ', $value) as $class) {
            $this->classes[$class] = $class;
        }
        return $this;
    }

    /**
     * Defines a CSS classes to remove
     * @param  string  $value CSS class
     * @return HTMLTag $this
     */
    public function removeClass($value)
    {
        foreach (explode(' ', $value) as $class) {
            unset($this->classes[$class]);
        }
        return $this;
    }

    /**
     * Defines a CSS class prefix
     * @param string  $value     CSS class
     * @return HTMLTag $this
     */
    public function setPrefix($value)
    {
        $this->classPrefix = $value;
        return $this;
    }

    /**
     * Gets list of void elements
     * @return array
     */
    public function getVoidElements()
    {
        return $this->config()->get('void_elements');
    }

    /**
     * Returns true if the current tag is a void element
     * @return boolean
     */
    public function isVoidElement()
    {
        return in_array(
            $this->tag,
            array_keys($this->VoidElements)
        );
    }

    /**
     * Returns the rendered html markup
     * @return string
     */
    public function Render()
    {
        $string = $this->string;
        $tag = $this->tag;

        $classes = $this->classes;
        if (Count($classes)) {
            if ($classPrefix = $this->classPrefix) {
                foreach ($classes as $key => $value) {
                    $prefixedClass = $classPrefix . '__' . $value;
                    $classes[$prefixedClass] = $prefixedClass;
                }
            }
            $this->addAttribute('class', implode(' ', $classes));
        }

        if ($this->isVoidElement() && $string) {
            if ($voidAttributeName = $this->VoidElements[$tag]) {
                $this->addAttribute($voidAttributeName, $string);
            } else {
                throw new InvalidArgumentException("Void element \"{$tag}\" cannot have string");
            }
        }

        $attributes = [];
        foreach ($this->attributes as $name => $value) {
            $attributes[] = sprintf(
                '%s="%s"',
                $name,
                Convert::raw2att($value)
            );
        }
        $attributes = Count($attributes) ? ' ' . implode(' ', $attributes) : '';

        if ($this->isVoidElement()) {
            return "<{$tag}{$attributes} />";
        }

        if (!isset($string) || !$string || $string == '') {
            return null;
        }

        return "<{$tag}{$attributes}>{$string}</{$tag}>";
    }

    /**
     * Returns the raw string value without html markup
     * @return string
     */
    public function Raw()
    {
        return $this->string;
    }

    /**
     * Returns the rendered html markup
     * @return string
     */
    public function forTemplate()
    {
        return $this->Render();
    }
}
