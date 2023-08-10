<?php

namespace Src\Extraction\TempTables;

use Src\Extraction\ReplicadoDB;
use Src\Utils\CommonUtils;

class TempManager
{
    public static function generateTempTables($scripts)
    {
        CommonUtils::timer(function () use ($scripts) {
            self::generator($scripts);
            }
        );

        echo PHP_EOL . PHP_EOL . str_repeat("-", 57) . PHP_EOL . PHP_EOL . PHP_EOL;
    }

    private function generator($scripts)
    {
        $total = count($scripts);
        $progress = 0;

        echo "Generating {$total} temp tables. This may take a few minutes..." . PHP_EOL;

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