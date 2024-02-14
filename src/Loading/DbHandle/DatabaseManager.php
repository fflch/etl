<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\DatabaseWorker;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

class DatabaseManager
{
    private $dbWorker;

    public function __construct()
    {
        $this->dbWorker = new DatabaseWorker();
    }

    public function wipeAndOrRenewTables(?array $wipeSchemas, array $renewOps)
    {
        try {
            Capsule::transaction(function() use ($wipeSchemas, $renewOps) {
                if (!empty($wipeSchemas)) {
                    CommonUtils::timer(function () use ($wipeSchemas) {
                        $this->dbWorker->wipeAllTables($wipeSchemas);
                    });
                    echo PHP_EOL;
                }

                CommonUtils::timer(function () use ($renewOps) {
                    $this->dbWorker->updateAllTables($renewOps);
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

    public function rebuildDB()
    {
        $this->nukeDB();
        $this->buildDB();
    }

    public function buildDB()
    {
        CommonUtils::timer(function () {
            $this->dbWorker->createAllTables();
        });

        $lines = str_repeat(PHP_EOL, 2);
        $lines .= str_repeat("-", 57);
        $lines .= str_repeat(PHP_EOL, 3);
        echo $lines;
    }

    public function nukeDB()
    {
        CommonUtils::timer(function () {
            $this->dbWorker->dropAllTables();
        });

        echo PHP_EOL;
    }
}