<?php

namespace gorriecoe\HTMLTag\View;

use SilverStripe\View\ViewableData;

 /**
  * HTMLTag
  *
  * @package silverstripe
  * @subpackage silverstripe-htmltag
  */
class HTMLTag extends ViewableData
{
    protected $string = null;

    protected $tag = null;

    protected $attributes = [];

    protected $classes = [];

    protected $classPrefix = null;

    public function __construct($string = null, $tag = null)
    {
        $this->string = $string;
        $this->tag = $tag;

        parent::__construct($string);
    }

    /**
     * Defines a HTML tag type
     * @param string $value      HTML tag type
     * @return HTMLTag $this
     */
    public function setTag($value)
    {
        $this->tag = $value;
        return $this;
    }

    /**
     * Defines an HTML attribute to add
     * @param [type] $attribute Attribute
     * @param [type] $value     Attribute value
     * @return HTMLTag $this
     */
    public function setAttribute($attribute = null, $value)
    {
        if ($value) {
            $this->attributes[$attribute] = $value;
        } else {
            unset($this->attributes[$attribute]);
        }
        return $this;
    }

    /**
     * Defines a CSS classes
     * @param string  $value     CSS class
     * @return HTMLTag $this
     */
    public function setID($value)
    {
        $this->setAttribute('id', $value);
        return $this;
    }

    /**
     * Defines CSS classes
     * @param string  $value     CSS class
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
     * @param string  $value     CSS class
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
     * @param  string  $value     CSS class
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

    public function forTemplate()
    {
        $string = $this->string;
        if (!isset($string) || !$string || $string == '') {
            return null;
        }
        $tag = $this->tag;
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $attributes[] = $key . "='$value'";
        }

        $classes = $this->classes;
        if (Count($classes)) {
            if ($classPrefix = $this->classPrefix) {
                foreach ($classes as $key => $value) {
                    $prefixedClass = $classPrefix . '__' . $value;
                    $classes[$prefixedClass] = $prefixedClass;
                }
            }
            $classes = implode(' ', $classes);
            $attributes[] = "class='$classes'";
        }

        $attributes = Count($attributes) ? ' ' . implode(' ', $attributes) : '';
        return "<$tag$attributes>$string</$tag>";
    }

    public function Raw()
    {
        return $this->string;
    }
}
