<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Extraction\TempTables\TempManager;
use Src\Loading\Scripts\Transactions;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\Operations\PessoasOps;
use Src\Loading\Operations\GraduacaoOps;
use Src\Loading\Operations\PosGraduacaoOps;
use Src\Loading\Operations\PosDocOps;
use Src\Loading\Operations\CEUOps;
use Src\Loading\Operations\ServidoresOps;

$preScripts = [
    'create_bolsasic_temp',
    'create_geral_temp',
    'create_posgrad_temp',
    'create_respostasQuest_temp',
    'create_supervisoesPD_temp',
    'create_ultimoBA_temp'
];

$schemas = [
    PessoasSchemas::class,
    GradSchemas::class,
    PosGradSchemas::class,
    PosDocSchemas::class,
    CEUSchemas::class,
    ServidoresSchemas::class,
];

$ops = [
    PessoasOps::class,
    GraduacaoOps::class,
    PosGraduacaoOps::class,
    PosDocOps::class,
    CEUOps::class,
    ServidoresOps::class,
];

TempManager::generateTempTables($preScripts);
Transactions::recreateAndOrUpdateTables($schemas, $ops);