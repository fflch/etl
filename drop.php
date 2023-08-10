<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

echo PHP_EOL . PHP_EOL;
echo "Wiping database...";
echo PHP_EOL . PHP_EOL . PHP_EOL;
echo str_repeat("-", 57);
echo PHP_EOL . PHP_EOL . PHP_EOL;

CommonUtils::timer(function () {

    Capsule::schema()->dropAllTables();

}, True);