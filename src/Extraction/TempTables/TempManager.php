<?php

namespace Src\Extraction\TempTables;

use Src\Extraction\ReplicadoDB;

class TempManager
{
    public static function generateTempTables($scripts)
    {
        foreach($scripts as $script) {
            $file = __DIR__ . '/Scripts/' . $script . '.sql';
            $stmts = file_get_contents($file);
            ReplicadoDB::executeBatch($stmts);
        }
    }
}