<?php

require_once __DIR__ . "/vendor/autoload.php";

use Src\Utils\CommonUtils;
use Src\Utils\MessageUtils;

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

CommonUtils::timer(function () use ($scripts) {
    foreach ($scripts as $script) {
        // run script
        include "src/Scripts/$script.php";

        // for cli readability
        echo MessageUtils::RULE_LINE;
        echo MessageUtils::eol(2);
    };
}, basename(__FILE__));