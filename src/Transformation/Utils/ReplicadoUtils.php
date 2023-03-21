<?php

namespace Src\Transformation\Utils;

class ReplicadoUtils
{
    public static function utf8_converter($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public static function trim_recursivo($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            $item = trim($item);
        });
        return $array;
    }
}