<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Utils\BuilderUtils;
use Src\Utils\CommonUtils;
use Src\Utils\MessageUtils;

ini_set('memory_limit', '2560M');

$scripts = [
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

CommonUtils::timer(function () use ($scripts, $forceBuildOrRebuild) {

    if ($forceBuildOrRebuild === true) {
        // trigger a (re)build
        BuilderUtils::setupDatabase($forceBuildOrRebuild);
    }

    foreach ($scripts as $script) {
        // run script
        include "src/Scripts/$script.php";

        // for cli readability
        echo MessageUtils::RULE_LINE;
        echo MessageUtils::eol(2);
    };
}, basename(__FILE__));
