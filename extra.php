<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Extraction\TempTables\TempManager;
use Src\Loading\DbHandle\DatabaseManager;
use Src\Utils\CommonUtils;
use Src\Utils\BuilderUtils;
use Src\Loading\SchemaBuilder\Schemas\LattesSchemas;
use Src\Loading\Operations\LattesOps;
use Src\Loading\SchemaBuilder\Schemas\QuestSocioEconSchemas;
use Src\Loading\Operations\QuestSocioEconOps;

pcntl_alarm(30 * 60); // Kills script if it's taking too long.

$tempTables = [
    'create_nuspsLattes_temp', // lattes
    'create_respostasQuest_temp', // questSocioEcon
];

$schemas = [
    LattesSchemas::class,
    QuestSocioEconSchemas::class
];

$ops = [
    LattesOps::class,
    QuestSocioEconOps::class
];


CommonUtils::timer(function () use ($tempTables, $ops) {

    // 1. Check current database structure
    BuilderUtils::validateCurrentDatabaseStructure(true);

    // 2. Generate necessary temp table
    TempManager::generateTempTables($tempTables);

    // 3. Write new records
    $dbManager = new DatabaseManager();
    $dbManager->wipeAndOrRenewTables([QuestSocioEconSchemas::class], $ops);

}, true);