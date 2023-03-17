<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Scripts\TablesCreation;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;
use Src\Loading\Scripts\TablesUpdate;
use Src\Loading\Operations\GraduacaoOperations;
use Src\Loading\Operations\PosGraduacaoOperations;
use Src\Loading\Operations\PosDocOperations;
use Src\Loading\Operations\ServidoresOperations;

$creator = new TablesCreation();
$creator->recreateTables(GradSchemas::class);
$creator->recreateTables(PosGradSchemas::class);
$creator->recreateTables(PosDocSchemas::class);
$creator->recreateTables(ServidoresSchemas::class);

$updater = new TablesUpdate();
$updater->update(GraduacaoOperations::class);
$updater->update(PosGraduacaoOperations::class);
$updater->update(PosDocOperations::class);
$updater->update(ServidoresOperations::class);