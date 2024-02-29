<?php

namespace Src\Extraction\TempTables;

use Src\Extraction\ReplicadoDB;
use Src\Utils\CommonUtils;
use Src\Utils\MessageUtils;

class TempManager
{
    public static function generateTempTables($scripts)
    {
        CommonUtils::timer(function () use ($scripts) {
            self::generator($scripts);
            }
        );

        echo MessageUtils::eol(1);
    }

    private static function generator($scripts)
    {
        $total = count($scripts);
        $progress = 0;

        echo MessageUtils::generatingTempTable($total);

        if (!count($scripts) > 0) {
            return CommonUtils::renderLoadingBar(1, 1);
        }

        foreach($scripts as $script) {
            CommonUtils::renderLoadingBar($progress, $total);

            $file = __DIR__ . '/Scripts/' . $script . '.sql';
            $stmts = file_get_contents($file);
            ReplicadoDB::executeBatch($stmts);

            $progress++;
            CommonUtils::renderLoadingBar($progress, $total);
        };
    }
}