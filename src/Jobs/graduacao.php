<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Jobs\Runner\Runner;

pcntl_alarm(25 * 60); // Kills job if it's taking too long.

$tempTables = [
    'create_graduacoes_temp',
    'create_bolsasic_temp',
    'create_turmasGR_temp',
    'create_demandaTurmasGR_temp',
    'create_trancamentosGR_temp',
];

$tableGroups = ['GraduacaoTables'];

Runner::runJob($tempTables, $tableGroups);
