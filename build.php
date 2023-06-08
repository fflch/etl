<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\DbHandle\DatabaseTasks;
use Src\Utils\CommonUtils;
use Src\Loading\SchemaBuilder\Schemas\PessoasSchemas;
use Src\Loading\SchemaBuilder\Schemas\GraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGraduacaoSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\CEUSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\SchemaBuilder\Schemas\CredenciamentosPGSchemas;
use Src\Loading\SchemaBuilder\Schemas\LattesSchemas;

$schemas = [
    PessoasSchemas::class,
    GraduacaoSchemas::class,
    PosGraduacaoSchemas::class,
    PosDocSchemas::class,
    CEUSchemas::class,
    ServidoresSchemas::class,
    CredenciamentosPGSchemas::class,
    LattesSchemas::class,
];

CommonUtils::timer(function () use ($schemas) {

    pcntl_alarm(15 * 60); // Kills script if it's taking too long.

    $tasks = new DatabaseTasks();
    $tasks->rebuild($schemas);

}, 'final');