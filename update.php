<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Extraction\TempTables\TempManager;
use Src\Loading\DbHandle\DatabaseTasks;
use Src\Utils\CommonUtils;
use Src\Utils\LoadingUtils;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\SchemaBuilder\Schemas\CredenciamentosPGSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\Operations\PessoasOps;
use Src\Loading\Operations\GraduacaoOps;
use Src\Loading\Operations\PosGraduacaoOps;
use Src\Loading\Operations\PosDocOps;
use Src\Loading\Operations\ServidoresOps;
use Src\Loading\Operations\CredenciamentosPGOps;
use Src\Loading\Operations\CEUOps;

pcntl_alarm(40 * 60); // Kills script if it's taking too long.

$preScripts = [
    'create_geral_temp', // pessoas
    'create_ultimoBA_temp', // graduacao
    'create_respostasQuest_temp', // graduacao
    'create_bolsasic_temp', // graduacao
    'create_turmasGraduacao_temp', // graduacao
    'create_demandaTurmas_temp', // graduacao
    'create_posgrad_temp', // posgraduacao
    'create_orientacoesPG_temp', // posgraduacao
    'create_supervisoesPD_temp', // posdoutorado
    'create_matriculasCCEX_temp', // ccex
    'create_inscricoesCCEX_temp', // ccex
    'create_vinculosServidores_temp', // servidores
    'create_credenciamentos_temp', // credenciamentosPG
];

$schemas = [
    PessoasSchemas::class,
    GraduacaoSchemas::class,
    PosGraduacaoSchemas::class,
    PosDocSchemas::class,
    ServidoresSchemas::class,
    CredenciamentosPGSchemas::class,
    CEUSchemas::class,
];

$ops = [
    PessoasOps::class,
    GraduacaoOps::class,
    PosGraduacaoOps::class,
    PosDocOps::class,
    ServidoresOps::class,
    CredenciamentosPGOps::class,
    CEUOps::class,
];


CommonUtils::timer(function () use ($preScripts, $argv, $schemas, $ops) {

    // 1. Build tables if needed or rebuild if requested
    LoadingUtils::conditionalRebuild($argv, 'pessoas', $schemas);

    // 2. Generate necessary temp tables
    TempManager::generateTempTables($preScripts);

    // 3. Wipe old records and write new ones
    $tasks = new DatabaseTasks();
    $tasks->wipeAndOrRenewTables($schemas, $ops);

}, True);