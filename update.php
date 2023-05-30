<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Extraction\TempTables\TempManager;
use Src\Loading\DbHandle\DatabaseTasks;
use Src\Utils\CommonUtils;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\SchemaBuilder\Schemas\CredenciamentosPGSchemas;
use Src\Loading\Operations\PessoasOps;
use Src\Loading\Operations\GraduacaoOps;
use Src\Loading\Operations\PosGraduacaoOps;
use Src\Loading\Operations\PosDocOps;
use Src\Loading\Operations\CEUOps;
use Src\Loading\Operations\ServidoresOps;
use Src\Loading\Operations\CredenciamentosPGOps;
use Illuminate\Database\Capsule\Manager as Capsule;

$preScripts = [
    'create_geral_temp', // pessoas
    'create_ultimoBA_temp', // graduacao
    'create_respostasQuest_temp', // graduacao
    'create_bolsasic_temp', // graduacao
    'create_consolidacaoTurma_temp', // graduacao
    'create_posgrad_temp', // posgraduacao
    'create_supervisoesPD_temp', // posdoutorado
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

    TempManager::generateTempTables($preScripts);

    $tasks = new DatabaseTasks();
    if (in_array("--rebuild", $argv)) $tasks->rebuild($schemas);
    $tasks->wipeAndOrRenewTables($schemas, $ops);

}, 'final');