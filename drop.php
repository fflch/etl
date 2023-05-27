<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\CommonUtils\CommonUtils;

CommonUtils::timer(function () {

    echo PHP_EOL . "Wiping database..." . PHP_EOL . PHP_EOL;
    echo str_repeat("-", 57) . PHP_EOL . PHP_EOL;
    Capsule::schema()->dropAllTables();

}, 'final');