<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Utils\CommonUtils;
use Src\Utils\BuilderUtils;

pcntl_alarm(10 * 60); // Kills script if it's taking too long.

CommonUtils::timer(function () {
    $tableGroups = BuilderUtils::getAllTableGroups();
    BuilderUtils::setupDatabase($tableGroups);
}, basename(__FILE__));