<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Scripts\TablesCreation;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;
use Src\Loading\SchemaBuilder\Schemas\ServidoresSchemas;

$creator = new TablesCreation();
$creator->dropTables(GradSchemas::class);
$creator->dropTables(PosGradSchemas::class);
$creator->dropTables(PosDocSchemas::class);
$creator->dropTables(ServidoresSchemas::class);