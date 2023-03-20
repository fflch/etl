<?php

namespace Src\Extraction;

use PDO;
use Src\Transformation\Utils\ReplicadoUtils;

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
                echo "Erro na conexão!\n";
                die();
            }
        }

        return self::$instance;
    }

    public static function getData(string $query, array $param = [])
    {
        $db = self::getInstance();

        $stmt = $db->prepare($query);

        try {
            $stmt->execute();
        }
        catch (Throwable $t) {
            echo "Erro na consulta!\n";
            die();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result) && getenv('REPLICADO_SYBASE') == 1) {
            $result = ReplicadoUtils::utf8_converter($result);
            $result = ReplicadoUtils::trim_recursivo($result);
        }

        return $result;
    }
}