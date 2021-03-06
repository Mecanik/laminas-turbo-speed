<?php
/**
 * Laminas Turbo Speed Module
 * 
 * @link https://github.com/Mecanik/LaminasTurboSpeed
 * @copyright Copyright (c) 2020 Norbert Boros ( a.k.a Mecanik )
 * @license https://github.com/Mecanik/LaminasTurboSpeed/blob/master/LICENSE.md
 */

namespace Mecanik\LaminasTurboSpeed\Engine;

class LaminasTurboSpeedCSSEngine
{
    public function __construct()
    {
    }

    public static function minify_css_callback($matches)
	{
        //print_r($matches);

        $openStyleTag = "<style{$matches[1]}";
        
        $css = $matches[2];
        
		// remove any comments
        $css = self::removeComments($css);
        
		// remove any CDATA section markers (if any)
        $css = self::removeCdata($css);
        
        // remove any whitespaces and new lines
        $css = self::removeSpaces($css);   

		return "{$openStyleTag}{$css}</style>";
    }

    protected static function removeComments($data)
    {
        if (false !== strpos($data, '/*')) {
            $data = str_replace("/*","_COMSTART",$data);
            $data = str_replace("*/","COMEND_",$data);
            $data = preg_replace("/_COMSTART.*?COMEND_/s","",$data);
        }

        return $data;
    }

    protected static function removeCdata($data)
	{
		if (false !== strpos($data, '<![CDATA[')) {
			$data = str_replace('//<![CDATA[', '', $data);
			$data = preg_replace('~/\*\s*<!\[CDATA\[\s*\*/~', '', $data);
			$data = str_replace('<![CDATA[', '', $data);
			$data = str_replace('//]]>', '', $data);
			$data = preg_replace('~/\*\s*\]\]>\s*\*/~', '', $data);
			$data = str_replace(']]>', '', $data);
        }
        
		return $data;
    }
    
    protected static function removeSpaces($data)
    {
        $data = preg_replace("/\s+/u", " ", $data);
        $data = str_replace(' ', '', $data);

        return $data;
    }
}