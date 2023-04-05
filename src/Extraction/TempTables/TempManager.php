<?php

namespace Src\Extraction\TempTables;

use Src\Extraction\ReplicadoDB;

class TempManager
{
    public static function generateTempTables()
    {
        $folder = __DIR__ . '/Scripts';

        $files = glob($folder . '/*.sql');

        foreach($files as $file) {
            $stmts = file_get_contents($file);
            ReplicadoDB::executeBatch($stmts);
        }
    }
}