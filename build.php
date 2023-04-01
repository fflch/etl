<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Extraction\TempTables\TempManager;
use Src\Loading\Scripts\DatabaseBuilder;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\Operations\PessoasOperations;
use Src\Loading\Operations\GraduacaoOperations;
use Src\Loading\Operations\PosGraduacaoOperations;
use Src\Loading\Operations\PosDocOperations;
use Src\Loading\Operations\CEUOperations;
use Src\Loading\Operations\ServidoresOperations;

TempManager::generateTempTables();

$bob = new DatabaseBuilder;

$schemas = [
    PessoasSchemas::class,
    GradSchemas::class,
    PosGradSchemas::class,
    PosDocSchemas::class,
    CEUSchemas::class,
    ServidoresSchemas::class
];

$ops = [
    PessoasOperations::class,
    GraduacaoOperations::class,
    PosGraduacaoOperations::class,
    PosDocOperations::class,
    CEUOperations::class,
    ServidoresOperations::class
];

$bob->dropAllTables($schemas);
$bob->createAllTables($schemas);
$bob->updateAllTables($ops);