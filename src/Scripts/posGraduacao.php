<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Src\Utils\ScriptUtils;

pcntl_alarm(25 * 60); // Kills script if it's taking too long.

$tempTables = [
    'create_areas_programas_hotfix',
    'create_posgrad_temp',
    'create_orientacoesPG_temp',
    'create_disciplinasPG_temp',
    'create_turmasPG_temp',
    'create_ocorrenciasPG_temp',
    'create_credenciamentos_temp',
];

$tableGroups = ['PosGraduacaoTables'];

ScriptUtils::runScript($tempTables, $tableGroups);
