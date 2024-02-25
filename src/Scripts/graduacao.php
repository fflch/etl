<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Utils\ScriptUtils;

pcntl_alarm(25 * 60); // Kills script if it's taking too long.

$tempTables = [
    'create_graduacoes_temp',
    'create_bolsasic_temp',
    'create_turmasGR_temp',
    'create_demandaTurmasGR_temp',
    'create_trancamentosGR_temp',
];

$tableGroups = ['GraduacaoTables'];

ScriptUtils::runScript($tempTables, $tableGroups);
