<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Utils\ScriptUtils;
use Illuminate\Database\Capsule\Manager as Capsule;

pcntl_alarm(25 * 60); // Kills script if it's taking too long.

$tempTables = ['create_respostasQuest_temp'];
$tableGroups = ['QuestSocioEconTables'];

Capsule::table('questionario_respostas')->truncate();
ScriptUtils::runScript($tempTables, $tableGroups);
