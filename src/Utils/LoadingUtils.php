<?php

namespace Src\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Loading\DbHandle\DatabaseTasks;

class LoadingUtils
{
    public static function conditionalRebuild(array $argv, string $primaryTable, array $schemasToCreate)
    {
        $tableExists = Capsule::schema()->hasTable($primaryTable);

        if ($tableExists === False || in_array("--rebuild", $argv)) {
            $tasks = new DatabaseTasks();
            $tasks->rebuild($schemasToCreate);
        }
    }
}