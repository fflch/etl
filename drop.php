<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Scripts\DatabaseBuilder;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\SchemaBuilder\Schemas\LattesSchemas;

$schemas = [
    PessoasSchemas::class,
    GradSchemas::class,
    PosGradSchemas::class,
    PosDocSchemas::class,
    CEUSchemas::class,
    ServidoresSchemas::class,
    LattesSchemas::class,
];

$bob = new DatabaseBuilder;
$bob->dropAllTables($schemas);