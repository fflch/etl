<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Utils\CommonUtils;
use Src\Utils\BuilderUtils;

pcntl_alarm(10 * 60); // Kills script if it's taking too long.

// user param
$forceRebuild = in_array("-y", $argv);

CommonUtils::timer(function () use ($forceRebuild) {
    BuilderUtils::setupDatabase($forceRebuild);
}, basename(__FILE__));