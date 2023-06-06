<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

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


$text1 = "Last <update.php> loading: {$updateTimeNotLattes}";
$text2 = "Last <lattes.php> loading: {$updateTimeLattes}";

$maxLength = max(mb_strlen($text1), mb_strlen($text2));
$paddingLen = 4;
$horizontalLine = str_repeat("═", $maxLength + $paddingLen);
$padding = str_repeat(" ", $paddingLen / 2);

echo PHP_EOL;
echo "╔" . $horizontalLine . "╗\n";
echo "║" . $padding . str_pad($text1, $maxLength) . $padding . "║" . PHP_EOL;
echo "║" . $padding . str_pad($text2, $maxLength) . $padding . "║" . PHP_EOL;
echo "╚" . $horizontalLine . "╝\n";
echo PHP_EOL . PHP_EOL;