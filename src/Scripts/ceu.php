<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Utils\ScriptUtils;

pcntl_alarm(25 * 60); // Kills script if it's taking too long.

$tempTables = [
    'create_matriculasCCEX_temp',
    'create_inscricoesCCEX_temp',
];

$tableGroups = ['CEUTables'];

ScriptUtils::runScript($tempTables, $tableGroups);
