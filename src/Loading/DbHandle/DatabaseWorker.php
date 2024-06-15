<?php

namespace Src\Loading\DbHandle;

use Src\Loading\SchemaBuilder\TableHandler;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\BuilderUtils;
use Src\Utils\CommonUtils;
use Src\Utils\LoadingUtils;
use Src\Utils\MessageUtils;

class DatabaseWorker
{
    public function processDBOperations(
        callable $operation,
        string $message,
        ?array $arg = null
    ) {
        echo $message;
        echo MessageUtils::eol(1);

        if (empty($arg)) {
            CommonUtils::renderLoadingBar(0, 1);
            $operation();
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

    public function createTables()
    {
        $message = "Creating tables:";

        $allTables = BuilderUtils::getAllETLTablesInfo(true);

        $operation = function ($table) {
            TableHandler::createTable($table);
        };

        $this->processDBOperations($operation, $message, $allTables);
    }

    public function dropTables()
    {
        $message = "Dropping tables:";

        $operation = function () {
            Capsule::schema()->dropAllTables();
        };

        $this->processDBOperations($operation, $message);
    }

    public function updateTables(array $groups)
    {
        $message = "Fetching data and writing new records:";

        $tables = BuilderUtils::getTablesInfoFromTableGroups($groups, true);

        $updateClasses = array_filter(array_column($tables, 'updateFunction'));

        $operation = function ($updateClass) {
            LoadingUtils::callUpdateFunction($updateClass);
        };

        $this->processDBOperations($operation, $message, $updateClasses);
    }

    public function WipeTables(array $groups)
    {
        if (empty($groups)) {
            return;
        }

        $message = "Wiping tables (if necessary):";

        $tables = BuilderUtils::getTablesNamesFromTableGroups($groups, true);

        $operation = function ($table) {
            Capsule::table($table)->delete();
        };

        Capsule::statement("SET FOREIGN_KEY_CHECKS = 0");

        $this->processDBOperations($operation, $message, array_reverse($tables));

        Capsule::statement("SET FOREIGN_KEY_CHECKS = 1");
    }
}
