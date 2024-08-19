<?php

namespace Src\Jobs\Runner;

use Src\Extraction\TempTables\TempManager;
use Src\Loading\DbHandle\DatabaseManager;
use Src\Extraction\ReplicadoDB;
use Src\Utils\CommonUtils;
use Src\Utils\BuilderUtils;

class Runner
{
    public static function runJob(
        array $tempTables,
        array $tableGroups,
        array $notToWipe = []
    ) {
        $backtrace = debug_backtrace()[0]['file'];
        $caller = basename($backtrace);
        echo "\n($caller)\n";

        CommonUtils::timer(function () use ($tempTables, $tableGroups, $notToWipe) {

            // 1. Check current database structure
            BuilderUtils::validateCurrentDatabaseStructure(true);

            // 2. Generate necessary temp tables
            TempManager::generateTempTables($tempTables);

            // 3. Wipe old records and write new ones
            $dbManager = new DatabaseManager();
            $dbManager->loadOrReloadTables($tableGroups, $notToWipe);

            // 4. Close Replicado DB connection
            ReplicadoDB::closeConnection();
        }, $caller);
    }
}
