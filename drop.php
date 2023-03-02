<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Scripts\TablesCreation;
use Src\Loading\SchemaBuilder\Schemas\GradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosGradSchemas;
use Src\Loading\SchemaBuilder\Schemas\PosDocSchemas;

$creator = new TablesCreation();
$creator->dropTables(GradSchemas::class);
$creator->dropTables(PosGradSchemas::class);
$creator->dropTables(PosDocSchemas::class);