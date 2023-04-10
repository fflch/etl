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
use Src\Loading\SchemaBuilder\Schemas\LattesSchemas;
use Src\Loading\Operations\PessoasOps;
use Src\Loading\Operations\GraduacaoOps;
use Src\Loading\Operations\PosGraduacaoOps;
use Src\Loading\Operations\PosDocOps;
use Src\Loading\Operations\CEUOps;
use Src\Loading\Operations\ServidoresOps;
use Src\Loading\Operations\LattesOps;

TempManager::generateTempTables();

$bob = new DatabaseBuilder;

$schemas = [
    PessoasSchemas::class,
    GradSchemas::class,
    PosGradSchemas::class,
    PosDocSchemas::class,
    CEUSchemas::class,
    ServidoresSchemas::class,
    // LattesSchemas::class
];

$ops = [
    PessoasOps::class,
    GraduacaoOps::class,
    PosGraduacaoOps::class,
    PosDocOps::class,
    CEUOps::class,
    ServidoresOps::class,
    // LattesOps::class
];

$bob->dropAllTables($schemas);
$bob->createAllTables($schemas);
$bob->updateAllTables($ops);