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
            echo MessageUtils::eol(3);

            CommonUtils::printTruncatedError($e->getMessage());

            if (str_contains($e->getMessage(), "too many placeholders")) {
                echo MessageUtils::eol(2);
                echo MessageUtils::ERROR_TABLE_ISSUE;
            }

            echo MessageUtils::eol(3);
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
                "Invalid value for \$queryType argument. " .
                "Expected 'full' or 'paginated'."
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

    public static function callUpdateFunction(string $updateClass)
    {
        [$classDir, $className] = explode('/', $updateClass);
        $classNamespace = "\\Src\\Loading\\Operations\\$classDir\\$className";

        $newClass = new $classNamespace;
        $newClass->update();
    }
}