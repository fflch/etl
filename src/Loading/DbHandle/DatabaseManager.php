<?php

namespace Src\Loading\DbHandle;

use Src\Loading\DbHandle\TableOperations;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

class DatabaseManager
{
    public function __construct()
    {
        $this->ops = new TableOperations();
    }

    public function processDBOperations(array $classes, callable $operation, string $message)
    {
        echo $message . PHP_EOL;

        $total = count($classes);
        $progress = 0;

        if (!count($classes) > 0) {
            return CommonUtils::renderLoadingBar(1, 1);
        }
    
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
        
        $message = "Creating schemas:";

        $this->processDBOperations($classes, $operation, $message);
    }

    public function updateAllTables(array $classes)
    {
        $operation = function ($class) {
            $this->ops->updateTables($class);
        };
        
        $message = "Writing new records:";

        $this->processDBOperations($classes, $operation, $message);
    }

    public function wipeAllTables(array $classes)
    {
        $operation = function ($class) {
            $this->ops->wipeTables($class);
        };
        
        $message = "Cleansing schemas:";

        $this->processDBOperations($classes, $operation, $message);
    }

    public function dropAllTables(array $classes)
    {
        $operation = function ($class) {
            $this->ops->dropTables($class);
        };
        
        $message = "Dropping schemas:";

        $this->processDBOperations($classes, $operation, $message);
    }
}