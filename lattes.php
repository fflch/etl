<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Extraction\TempTables\TempManager;
use Src\Loading\DbHandle\DatabaseTasks;
use Src\Utils\CommonUtils;
use Src\Utils\LoadingUtils;
use Src\Loading\SchemaBuilder\Schemas\LattesSchemas;
use Src\Loading\Operations\LattesOps;

pcntl_alarm(30 * 60); // Kills script if it's taking too long.

$preScripts = ['create_nuspsLattes_temp'];

$schemas = [LattesSchemas::class];
$ops = [LattesOps::class];


CommonUtils::timer(function () use ($preScripts, $argv, $schemas, $ops) {

    // 1. Build table if needed or rebuild if requested
    LoadingUtils::conditionalRebuild($argv, 'lattes', $schemas);

    // 2. Generate necessary temp table
    TempManager::generateTempTables($preScripts);

    // 3. Write new records
    $tasks = new DatabaseTasks();
    $tasks->wipeAndOrRenewTables(NULL, $ops);

}, True);