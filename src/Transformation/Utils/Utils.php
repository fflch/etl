<?php

namespace Src\Transformation\Utils;

class Utils
{
    public static function emptiesToNull(Array $attrs)
    {
        foreach($attrs as $key => $value){
            $newAttrs[$key] = !empty($value) ? $value : NULL;
        }

        return $newAttrs;
    }
}