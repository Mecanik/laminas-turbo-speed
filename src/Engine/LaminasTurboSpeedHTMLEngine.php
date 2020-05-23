<?php
/**
 * Laminas Turbo Speed Module
 * 
 * @link https://github.com/Mecanik/LaminasTurboSpeed
 * @copyright Copyright (c) 2020 Norbert Boros ( a.k.a Mecanik )
 * @license https://github.com/Mecanik/LaminasTurboSpeed/blob/master/LICENSE.md
 */

namespace Mecanik\LaminasTurboSpeed\Engine;

class LaminasTurboSpeedHTMLEngine
{
    public function __construct()
    {
    }

    public static function remove_comments_callback($matches)
	{
		return (0 === strpos($matches[1], '[') || false !== strpos($matches[1], '<![')) ? $matches[0] : '';
    }
}