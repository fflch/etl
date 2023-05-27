<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\TableOperations;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\CommonUtils\CommonUtils;

class DatabaseManager
{
    public function __construct()
    {
        $this->ops = new TableOperations();
    }

    public function processDBOperations(array $classes, callable $operation, string $message)
    {
        echo $message;

        if (count($classes) > 0) {
            $total = count($classes);
            $progress = 0;
        }
        else {
            CommonUtils::renderLoadingBar(1, 1);
        };
    
        foreach ($classes as $class) {
            CommonUtils::renderLoadingBar($progress, $total);
            $operation($class);
    
            $progress++;
            CommonUtils::renderLoadingBar($progress, $total);
        }
    }

    public function createAllTables(array $classes)
    {
        $operation = function ($class) {
            $this->ops->createTables($class);
        };
        
        $message = PHP_EOL . "Creating schemas:" . PHP_EOL;

        $this->processDBOperations($classes, $operation, $message);
    }

    public function updateAllTables(array $classes)
    {
        $operation = function ($class) {
            $this->ops->updateTables($class);
        };
        
        $message = "Writing new records:" . PHP_EOL;

        $this->processDBOperations($classes, $operation, $message);
    }

    public function wipeAllTables(array $classes)
    {
        $operation = function ($class) {
            $this->ops->wipeTables($class);
        };
        
        $message = "Cleansing old schemas (if needed):" . PHP_EOL;

        $this->processDBOperations($classes, $operation, $message);
    }

    public function dropAllTables(array $classes)
    {
        $operation = function ($class) {
            $this->ops->dropTables($class);
        };
        
        $message = "Dropping schemas (if they exist):" . PHP_EOL;

        $this->processDBOperations($classes, $operation, $message);
    }
}