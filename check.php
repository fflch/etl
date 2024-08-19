<?php

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;
use Src\Utils\MessageUtils;

$db = getenv('DB_DATABASE');

$representativeTables = [
    'pessoas' => 'pessoas',
    'graduacao' => 'graduacoes',
    'posGraduacao' => 'posgraduacoes',
    'pesquisasAvancadas' => 'pesquisas_avancadas',
    'servidores' => 'vinculos_servidores',
    'ceu' => 'cursos_culturaextensao',
    'programasUSP' => 'auxilios_concedidos',
    'questSocioEcon' => 'questionario_respostas',
    'lattes' => 'lattes',
];

$lastUpdates = [];
foreach ($representativeTables as $group => $table) {
    $lastUpdate = Capsule::select(
        "SELECT CONVERT_TZ(last_update, @@session.time_zone, '+00:00') AS 'last_update_utc' 
        FROM mysql.innodb_table_stats
        WHERE database_name = '{$db}'
            AND table_name = '{$table}'
            AND n_rows > 0"
    )->last_update_utc ?? null;

    $timeDiff = CommonUtils::getTimeDiffSinceLastUpdate($lastUpdate);
    $lastUpdates[$group] = $timeDiff;
}

echo MessageUtils::eol(2);

$texts = [""];
foreach ($lastUpdates as $k => $v) {
    $texts[] = "Last <$k.php> loading: {$v}";
    $texts[] = "";
}

CommonUtils::prettyPrint($texts);
