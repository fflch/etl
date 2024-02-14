<?php

namespace Src\Loading\DbHandle;

use Src\Loading\SchemaBuilder\TableHandler;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\BuilderUtils;
use Src\Utils\CommonUtils;
use Src\Utils\LoadingUtils;

class DatabaseWorker
{
    public function processDBOperations(
        callable $operation,
        string $message,
        ?array $arg = null
    )
    {
        echo $message . PHP_EOL;

        if (empty($arg)) {
            CommonUtils::renderLoadingBar(0, 1);
            $operation($arg);
            return CommonUtils::renderLoadingBar(1, 1);
        }

        $total = count($arg);
        $progress = 0;
    
        foreach ($arg as $argElement) {
            CommonUtils::renderLoadingBar($progress, $total);
            $operation($argElement);

            $progress++;
            CommonUtils::renderLoadingBar($progress, $total);
        }
    }

    public function createAllTables()
    {
        $message = "Creating schemas:";

        $allTables = BuilderUtils::getAllETLTablesInfo();

        $operation = function ($table) {
            TableHandler::createTable($table);
        };

        $this->processDBOperations($operation, $message, $allTables);
    }

    public function dropAllTables()
    {
        $message = "Dropping schemas:";

        $operation = function () {
            Capsule::schema()->dropAllTables();
        };

        $this->processDBOperations($operation, $message);
    }

    public function updateAllTables(array $classes)
    {
        $message = "Writing new records:";

        $operation = function ($class) {
            LoadingUtils::callAllUpdateMethodsFromClass($class);
        };

        $this->processDBOperations($operation, $message, $classes);
    }

    public function wipeAllTables(array $classes)
    {
        $message = "Cleansing schemas (if necessary):";

        $tables = BuilderUtils::getTablesNamesFromSchemasClasses($classes);

        $operation = function ($table) {
            Capsule::table($table)->delete();
        };
        
        Capsule::statement("SET FOREIGN_KEY_CHECKS = 0");

        // in reverse for performance reasons
        $this->processDBOperations($operation, $message, array_reverse($tables));

        Capsule::statement("SET FOREIGN_KEY_CHECKS = 1");
    }
}