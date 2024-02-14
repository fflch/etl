<?php

namespace Src\Utils;

require_once __DIR__ . "/../../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class LoadingUtils
{
    public static function insertIntoTable(string $queryType, object $object, string $model)
    {
        $insertLimit = self::getInsertLimit($model);

        try {
            self::transformAndInsert($queryType, $object, $model, $insertLimit);
        }
        catch (\Exception $e) {
            echo str_repeat(PHP_EOL, 3);

            CommonUtils::printTruncatedError($e->getMessage());

            if (str_contains($e->getMessage(), "too many placeholders")) {
                echo str_repeat(PHP_EOL, 3);
                echo("Your database may be outdated. " .
                    "Please, try rebuilding it using the `builder.php` script."
                );
            }

            echo str_repeat(PHP_EOL, 3);
            die();
        }
    }

    private static function transformAndInsert($queryType, $object, $model, $insertLimit)
    {
        if ($queryType == "full") {
            $data = $object->transformData();
            self::chunkInsert($data, $insertLimit, $model);
        }
        elseif ($queryType == "paginated") {
            $pagination = ['limit' => ($insertLimit * 5), 'offset' => 0];
            do {
                $data = $object->transformData($pagination);
                self::chunkInsert($data, $insertLimit, $model);
                $pagination['offset'] += $pagination['limit'];
            } while (!empty($data));
        }
        else {
            throw new \Exception(
                "Invalid value for \$queryType argument. Expected 'full' or 'paginated'."
            );
            die();
        }
    }

    private static function chunkInsert($data, $insertLimit, $model)
    {
        foreach(array_chunk($data, $insertLimit) as $chunk) {
            $model::insert($chunk);
        }
    }

    private static function getInsertLimit(string $model)
    {
        $tableName = (new $model)->getTable();
        $columns = Capsule::schema()->getColumnListing($tableName);
        $numColumns = count($columns);

        return floor(65000 / $numColumns);
    }

    private static function getAllUpdateMethodsFromClass(string $class)
    {
        return array_filter(get_class_methods($class), function($method) {
            return $method !== '__construct';
        });
    }

    public static function callAllUpdateMethodsFromClass(string $class)
    {
        $classMethods = self::getAllUpdateMethodsFromClass($class);

        $class = new $class;

        foreach($classMethods as $method) {
            $class->{$method}();
        }
    }
}