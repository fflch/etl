<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

$db = getenv('DB_DATABASE');

$updateTimeNotLattes = Capsule::select(
    "SELECT MAX(last_update) AS 'last_update'
    FROM mysql.innodb_table_stats
    WHERE database_name = '{$db}'
        AND table_name <> 'lattes'"
)[0]->last_update ?? 'No available data';

$updateTimeLattes = Capsule::select(
    "SELECT MAX(last_update) AS 'last_update'
    FROM mysql.innodb_table_stats 
    WHERE database_name = '{$db}'
        AND table_name = 'lattes'"
)[0]->last_update ?? 'No available data';

echo PHP_EOL . PHP_EOL;
$text1 = "Last <update.php> loading: {$updateTimeNotLattes}";
$text2 = "Last <lattes.php> loading: {$updateTimeLattes}";

CommonUtils::prettyPrint([$text1, $text2]);