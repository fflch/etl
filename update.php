<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Extraction\TempTables\TempManager;
use Src\Loading\DbHandle\DatabaseTasks;
use Src\Utils\CommonUtils;
use Src\Utils\LoadingUtils;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PesquisasAvancadasSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ProgramasUSPSchemas;
use Src\Loading\Operations\PessoasOps;
use Src\Loading\Operations\GraduacaoOps;
use Src\Loading\Operations\PosGraduacaoOps;
use Src\Loading\Operations\PesquisasAvancadasOps;
use Src\Loading\Operations\ServidoresOps;
use Src\Loading\Operations\CEUOps;
use Src\Loading\Operations\ProgramasUSPOps;

pcntl_alarm(40 * 60); // Kills script if it's taking too long.

$preScripts = [
    'create_areas_programas_hotfix', // base
    'create_titulos_temp', // pessoas
    'create_graduacoes_temp', // graduacao
    'create_respostasQuest_temp', // graduacao
    'create_bolsasic_temp', // graduacao
    'create_turmasGR_temp', // graduacao
    'create_demandaTurmasGR_temp', // graduacao
    'create_trancamentosGR_temp', // graduacao
    'create_posgrad_temp', // posgraduacao
    'create_orientacoesPG_temp', // posgraduacao
    'create_disciplinasPG_temp', // posgraduacao
    'create_turmasPG_temp', // posgraduacao
    'create_ocorrenciasPG_temp', // posgraduacao
    'create_credenciamentos_temp', // posgraduacao
    'create_supervisoesPD_temp', // pesquisasAvancadas
    'create_matriculasCCEX_temp', // ccex
    'create_inscricoesCCEX_temp', // ccex
    'create_vinculosServidores_temp', // servidores
];

$schemas = [
    PessoasSchemas::class,
    GraduacaoSchemas::class,
    PosGraduacaoSchemas::class,
    PesquisasAvancadasSchemas::class,
    ServidoresSchemas::class,
    CEUSchemas::class,
    ProgramasUSPSchemas::class,
];

$ops = [
    PessoasOps::class,
    GraduacaoOps::class,
    PosGraduacaoOps::class,
    PesquisasAvancadasOps::class,
    ServidoresOps::class,
    CEUOps::class,
    ProgramasUSPOps::class,
];


CommonUtils::timer(function () use ($preScripts, $argv, $schemas, $ops) {

    // 1. Build tables if needed or rebuild them if requested
    $rebuild = LoadingUtils::conditionalBuild($argv, $schemas);

    // 2. Generate necessary temp tables
    TempManager::generateTempTables($preScripts);

    // 3. Wipe old records and write new ones
    $tasks = new DatabaseTasks();
    $tasks->wipeAndOrRenewTables($rebuild, $schemas, $ops);

}, True);