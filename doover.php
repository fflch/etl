<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Script;
use Src\Loading\SchemaBuilder\Builder;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;

$builder = new Builder();
$script = new Script();

$refl = new ReflectionClass(GradSchemas::class);
$tables = $refl->getConstants();

foreach($tables as $table)
{
    $builder->dropTable($table);
}

foreach($tables as $table)
{
    $builder->createTable($table);
}

$script->updateAlunosGraduacao();
$script->updateGraduacoes();
$script->updateHabilitacoes();