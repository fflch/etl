<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Jobs\Runner\Runner;

pcntl_alarm(30 * 60); // Kills job if it's taking too long.

$tempTables = ['create_nuspsLattes_temp'];
$tableGroups = ['LattesTables'];

Runner::runJob($tempTables, $tableGroups, ['LattesTables']);
