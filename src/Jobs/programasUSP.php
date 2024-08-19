<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Jobs\Runner\Runner;

pcntl_alarm(25 * 60); // Kills job if it's taking too long.

$tempTables = [];
$tableGroups = ['ProgramasUSPTables'];

Runner::runJob($tempTables, $tableGroups);
