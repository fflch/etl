<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Utils\ScriptUtils;

pcntl_alarm(30 * 60); // Kills script if it's taking too long.

$tempTables = ['create_nuspsLattes_temp'];
$tableGroups = ['LattesTables'];

ScriptUtils::runScript($tempTables, $tableGroups, ['LattesTables']);
