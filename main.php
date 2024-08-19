<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Utils\BuilderUtils;
use Src\Utils\CommonUtils;
use Src\Utils\MessageUtils;

ini_set('memory_limit', '4G');

$jobs = [
    'pessoas',
    'graduacao',
    'posGraduacao',
    'pesquisasAvancadas',
    'servidores',
    'ceu',
    'programasUSP',
    'questSocioEcon',
    'lattes',
];

// user param
$forceBuildOrRebuild = in_array("-f", $argv);

CommonUtils::timer(function () use ($jobs, $forceBuildOrRebuild) {

    if ($forceBuildOrRebuild === true) {
        // trigger a (re)build
        BuilderUtils::setupDatabase($forceBuildOrRebuild);
    }

    foreach ($jobs as $job) {
        // run job
        include "src/Jobs/$job.php";

        // for cli readability
        echo MessageUtils::RULE_LINE;
        echo MessageUtils::eol(2);
    };
}, basename(__FILE__));
