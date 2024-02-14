<?php

namespace Src\Extraction;

use PDO;
use Src\Utils\TransformationUtils;

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
                echo "Erro na conexão! {$t}";
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
        catch (\Throwable $t) {
            echo "Erro na consulta! {$t}";
            die();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result) && getenv('REPLICADO_SYBASE') == 1) {
            $result = TransformationUtils::utf8_converter($result);
            $result = array_map(function($arr) {
                return array_map([TransformationUtils::class, 'initialDataCleanup'], $arr);
            }, $result);
        }

        return $result;
    }

    public static function executeBatch(string $query)
    {
        $db = self::getInstance();

        $statements = explode(';', $query);
        
        $statements = array_filter($statements);
        
        try {
            foreach ($statements as $statement) {
                $stmt = $db->prepare($statement);
                $stmt->execute();
            } 
        } catch (\Exception $e) {
            $wasTimedOut = strpos($e->getMessage(), "Changed database context");

            if ($wasTimedOut !== false) {
                echo "\n\n\n" . "An error occurred: Connection timed out." . "\n";
            } else {
                echo "\n\n\n" . "Caught Exception: {$e}" . "\n\n";
            }

            echo "Exiting the script...\n\n";
            die();
        }
    }
}