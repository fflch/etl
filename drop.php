<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;
use Src\Utils\MessageUtils;

echo MessageUtils::WIPING_DB;

CommonUtils::timer(function () {
    Capsule::schema()->dropAllTables();
}, basename(__FILE__));