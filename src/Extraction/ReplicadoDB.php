<?php

namespace Src\Extraction;

use PDO;
use Src\Transformation\Utils\Utils;

class ReplicadoDB
{
    private static $instance;

    private static function getInstance()
    {
        $host = getenv('REPLICADO_HOST');
        $port = getenv('REPLICADO_PORT');
        $db = getenv('REPLICADO_DATABASE');
        $user = getenv('REPLICADO_USERNAME');
        $pass = getenv('REPLICADO_PASSWORD');

        if (!self::$instance) {
            try {
                $dsn = "dblib:host={$host}:{$port};dbname={$db}";
                self::$instance = new PDO($dsn, $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Throwable $t) {
                echo PHP_EOL . "Erro na conexão! {$t}" . PHP_EOL;
                die();
            }
        }

        return self::$instance;
    }

    public static function fetchData(string $query, array $param = [])
    {
        $db = self::getInstance();

        $stmt = $db->prepare($query);

        try {
            $stmt->execute();
        }
        catch (Throwable $t) {
            echo PHP_EOL . "Erro na consulta! {$t}" . PHP_EOL;
            die();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result) && getenv('REPLICADO_SYBASE') == 1) {
            $result = Utils::utf8_converter($result);
            $result = Utils::trim_recursivo($result);
        }

        return $result;
    }

    public static function executeBatch(string $query)
    {
        $db = self::getInstance();

        $statements = explode(';', $query);
        
        $statements = array_filter($statements);
        
        foreach ($statements as $statement) {
            $stmt = $db->prepare($statement);
            $stmt->execute();
        }
    }
}