<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Scripts\TablesCreation;
use Src\Loading\Scripts\GradTables;
use Src\Loading\Scripts\PosGradTables;

$creator = new TablesCreation();
$creator->newGradTables();
$creator->newPosGradTables();

$gradTables = new GradTables();
$gradTables->update();

$posGradTables = new PosGradTables();
$posGradTables->update();