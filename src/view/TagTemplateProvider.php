<?php

namespace gorriecoe\HTMLTag\View;

use SilverStripe\View\TemplateGlobalProvider;
use gorriecoe\HTMLTag\View\HTMLTag;

/**
 * Adds tag methods to templates
 *
 * @package silverstripe
 * @subpackage silverstripe-htmltag
 */
class TagTemplateProvider implements TemplateGlobalProvider
{
    /**
     * @return array|void
     */
    public static function get_template_global_variables()
    {
        return [
            'tag' => 'tag',
            'h1' => 'h1',
            'h2' => 'h2',
            'h3' => 'h3',
            'h4' => 'h4',
            'h5' => 'h5',
            'h6' => 'h6',
            'p' => 'p',
            'div' => 'div',
            'span' => 'span'
        ];
    }

    /**
     * @param $string
     * @param $tag
     * @return HTMLTag
     */
    public static function tag($string, $tag)
    {
        return HTMLTag::create($string, $tag);
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function h1($string)
    {
        return HTMLTag::create($string, 'h1');
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function h2($string)
    {
        return HTMLTag::create($string, 'h2');
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function h3($string)
    {
        return HTMLTag::create($string, 'h3');
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function h4($string)
    {
        return HTMLTag::create($string, 'h4');
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function h5($string)
    {
        return HTMLTag::create($string, 'h5');
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function h6($string)
    {
        return HTMLTag::create($string, 'h6');
    }

    /**
     * @param $string
     * @param $tag
     * @return HTMLTag
     */
    public static function p($string)
    {
        return HTMLTag::create($string, 'p');
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function div($string)
    {
        return HTMLTag::create($string, 'div');
    }

    /**
     * @param $string
     * @return HTMLTag
     */
    public static function span($string)
    {
        return HTMLTag::create($string, 'span');
    }
}
