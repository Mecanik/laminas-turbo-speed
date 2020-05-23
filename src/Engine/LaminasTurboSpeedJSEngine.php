<?php
/**
 * Laminas Turbo Speed Module
 * 
 * @link https://github.com/Mecanik/LaminasTurboSpeed
 * @copyright Copyright (c) 2020 Norbert Boros ( a.k.a Mecanik )
 * @license https://github.com/Mecanik/LaminasTurboSpeed/blob/master/LICENSE.md
 */

namespace Mecanik\LaminasTurboSpeed\Engine;

class LaminasTurboSpeedJSEngine
{
    public function __construct()
    {
    }

    public static function minify_js_callback($matches)
	{

        $openScriptTag = "<script{$matches[2]}";
        $js = $matches[3];

		// remove any comments
        $js = self::removeComments($js);

        // remove spaces and linebreaks
        $js = self::removeSpaces($js);
        
		return "{$openScriptTag}{$js}</script>";
    }

    protected static function removeComments($data)
    {
        $data = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\\\|\')\/\/.*))/u', '', $data);

        return $data;
    }

    protected static function removeSpaces($data)
    {    
        // remove whitespace from start - end
        $data = trim($data);

        // remove line breaks
        $data = preg_replace(["/\s+\n/","/\n\s+/","/ +/"], ["\n","\n "," "], $data);

        return $data;
    }
}