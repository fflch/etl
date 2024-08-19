<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Jobs\Runner\Runner;

pcntl_alarm(25 * 60); // Kills job if it's taking too long.

$tempTables = ['create_respostasQuest_temp'];
$tableGroups = ['QuestSocioEconTables'];

Capsule::table('questionario_respostas')->truncate();
Runner::runJob($tempTables, $tableGroups);
