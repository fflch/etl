<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Scripts\TablesUpdate;
use Src\Loading\Operations\GraduacaoOperations;
use Src\Loading\Operations\PosGraduacaoOperations;
use Src\Loading\Operations\PosDocOperations;

$updater = new TablesUpdate();
$updater->update(GraduacaoOperations::class);
$updater->update(PosGraduacaoOperations::class);
$updater->update(PosDocOperations::class);