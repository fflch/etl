<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\DatabaseManager;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\CommonUtils\CommonUtils;

class DatabaseTasks
{
    public function __construct()
    {
        $this->dbManager = new DatabaseManager();
    }

    public function wipeAndOrRenewTables(array $wipeSchemas, array $renewOps)
    {
        try {
            Capsule::transaction(function() use ($wipeSchemas, $renewOps) {
                CommonUtils::timer(function () use ($wipeSchemas) {
                    $this->dbManager->wipeAllTables($wipeSchemas);
                });
                echo PHP_EOL;

                CommonUtils::timer(function () use ($renewOps) {
                    $this->dbManager->updateAllTables($renewOps);
                });
                echo PHP_EOL . str_repeat("-", 57) . PHP_EOL . PHP_EOL;
            });
        }
        catch(\Exception $e) {
            echo "Caught Exception: " . $e;
        }
    }

    public function rebuild($classes)
    {
        CommonUtils::timer(function () use ($classes) {
            echo "(Re)building schemas..." . PHP_EOL . PHP_EOL;

            Capsule::statement("SET FOREIGN_KEY_CHECKS = 0");
            $this->dbManager->dropAllTables($classes);
            Capsule::statement("SET FOREIGN_KEY_CHECKS = 1");
            $this->dbManager->createAllTables($classes);
        });

        echo PHP_EOL . str_repeat("-", 57) . PHP_EOL . PHP_EOL;
    }
}
