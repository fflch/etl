<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

echo PHP_EOL . "Wiping database...";
echo PHP_EOL . PHP_EOL . str_repeat("-", 57) . PHP_EOL;

CommonUtils::timer(function () {

    Capsule::schema()->dropAllTables();

}, True);