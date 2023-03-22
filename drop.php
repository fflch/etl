<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Loading\Scripts\DatabaseBuilder;

$bob = new DatabaseBuilder;
$bob->dropAllTables();