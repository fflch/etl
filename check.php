<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

$db = getenv('DB_DATABASE');

$mainLastUpdate = Capsule::select(
    "SELECT MAX(last_update) AS 'last_update'
    FROM mysql.innodb_table_stats
    WHERE database_name = '{$db}'
        AND table_name NOT IN ('lattes', 'questionario_questoes', 'questionario_respostas')"
)[0]->last_update ?? 'No available data';

$extraLastUpdate = Capsule::select(
    "SELECT MAX(last_update) AS 'last_update'
    FROM mysql.innodb_table_stats 
    WHERE database_name = '{$db}'
        AND table_name IN ('lattes', 'questionario_questoes', 'questionario_respostas')"
)[0]->last_update ?? 'No available data';

echo PHP_EOL . PHP_EOL;
$text1 = "Last <main.php> loading: {$mainLastUpdate}";
$text2 = "Last <extra.php> loading: {$extraLastUpdate}";

CommonUtils::prettyPrint([$text1, $text2]);