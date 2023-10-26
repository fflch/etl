<?php

namespace Src\Utils;

require_once __DIR__ . "/../../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Loading\DbHandle\TableOperations;
use Src\Loading\DbHandle\DatabaseTasks;

class LoadingUtils
{
    public static function conditionalBuild(array $argv, array $schemasClasses)
    {
        $wantsBuild = in_array("build.php", $argv);
        $wantsRebuild = in_array("--rebuild", $argv);

        $expectedUserSchemas = self::getScriptSchemas($schemasClasses);
        $userSchemas = self::getUserSchemas();
        $missingSchemas = !empty(array_diff($expectedUserSchemas, $userSchemas));

        $decision = self::buildDecision($wantsBuild, $wantsRebuild, $userSchemas, $missingSchemas);
        self::buildMessage($userSchemas, $missingSchemas, $wantsRebuild);

        return self::buildAction($decision, $schemasClasses);
    }

    private static function buildDecision($wantsBuild, $wantsRebuild, $userSchemas, $missingSchemas)
    {
        if ($wantsBuild || count($userSchemas) == 0) {
            return 'build';
        }
        elseif ($wantsRebuild || $missingSchemas) {
            return 'rebuild';
        }
        else {
            return null;
        }
    }

    private static function buildMessage($userSchemas, $missingSchemas, $wantsRebuild)
    {
        echo PHP_EOL . PHP_EOL;

        if (count($userSchemas) == 0) {
            echo "It seems there are no tables in your database." . PHP_EOL;
            echo "Let's construct the ones you'll need." . PHP_EOL . PHP_EOL . PHP_EOL;
        }
        elseif($missingSchemas && !$wantsRebuild) {
            echo "It seems you are missing some table(s)." . PHP_EOL;
            echo "Database needs rebuilding." . PHP_EOL . PHP_EOL . PHP_EOL;
        }

        return;
    }

    private static function buildAction($decision, $schemasClasses)
    {
        $tasks = new DatabaseTasks();

        if ($decision == 'build') {
            $tasks->build($schemasClasses);
            return True;
        }
        if ($decision == 'rebuild') {
            $tasks->rebuild($schemasClasses);
            return True;
        }
        else {
            return False;
        }
    }

    private static function getScriptSchemas($schemasClasses)
    {
        $expectedSchemas = [];

        $ops = new TableOperations;

        foreach($schemasClasses as $schemasClass) {
            $tables = $ops->getTablesNames($schemasClass);
            foreach($tables as $table) {
                $expectedSchemas[] = $table['tableName'];
            }
        }

        return $expectedSchemas;
    }

    private static function getUserSchemas()
    {
        $tables = Capsule::schema()->getAllTables();

        $tableNames = [];
        foreach ($tables as $table) {
            $tableNames[] = $table->{"Tables_in_" . $_ENV['DB_DATABASE']};
        }

        return $tableNames;
    }
}