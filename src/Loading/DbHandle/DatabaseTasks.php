<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\DatabaseManager;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

class DatabaseTasks
{
    public function __construct()
    {
        $this->dbManager = new DatabaseManager();
    }

    public function wipeAndOrRenewTables(bool $rebuild, ?array $wipeSchemas, array $renewOps)
    {
        try {
            Capsule::transaction(function() use ($rebuild, $wipeSchemas, $renewOps) {
                if (!empty($wipeSchemas) && $rebuild === False) {
                    CommonUtils::timer(function () use ($wipeSchemas) {
                        $this->dbManager->wipeAllTables($wipeSchemas);
                    });
                    echo PHP_EOL;
                }

                CommonUtils::timer(function () use ($renewOps) {
                    $this->dbManager->updateAllTables($renewOps);
                });
                echo PHP_EOL . PHP_EOL . str_repeat("-", 57) . PHP_EOL . PHP_EOL . PHP_EOL;
            });
        }
        catch(\Exception $e) {
            echo "\n\n" . "Caught Exception: " . $e . "\n\n";
            echo "Exiting the script...\n\n";
            exit();
        }
    }

    public function rebuild($classes)
    {
        $this->destroy($classes);
        $this->build($classes);
    }

    public function build($classes)
    {
        CommonUtils::timer(function () use ($classes) {
            $this->dbManager->createAllTables($classes);
        });

        echo PHP_EOL . PHP_EOL . str_repeat("-", 57) . PHP_EOL . PHP_EOL . PHP_EOL;
    }

    public function destroy($classes)
    {
        Capsule::statement("SET FOREIGN_KEY_CHECKS = 0");

        CommonUtils::timer(function () use ($classes) {
            $this->dbManager->dropAllTables($classes);
        });

        Capsule::statement("SET FOREIGN_KEY_CHECKS = 1");
        echo PHP_EOL;
    }
}
