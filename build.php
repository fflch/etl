<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\DbHandle\DatabaseTasks;
use Src\CommonUtils\CommonUtils;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\SchemaBuilder\Schemas\CredenciamentosPGSchemas;

$schemas = [
    PessoasSchemas::class,
    GraduacaoSchemas::class,
    PosGraduacaoSchemas::class,
    PosDocSchemas::class,
    CEUSchemas::class,
    ServidoresSchemas::class,
    CredenciamentosPGSchemas::class,
];

echo PHP_EOL;

CommonUtils::timer(function () use ($schemas) {

    $tasks = new DatabaseTasks();
    $tasks->rebuild($schemas);

}, 'final');