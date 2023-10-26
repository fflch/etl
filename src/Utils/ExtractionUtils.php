<?php

namespace Src\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\CommonUtils;

class ExtractionUtils
{
    public static function updateTable(string $queryType, object $object, string $model)
    {
        $insertLimit = self::getInsertLimit($model);

        try {
            self::transformAndInsert($queryType, $object, $model, $insertLimit);
        }
        catch (\Exception $e) {
            echo str_repeat(PHP_EOL, 5);

            if (str_contains($e->getMessage(), "too many placeholders")) {
                echo("An error ocurred: it seems your database is outdated.\nTry rebuilding it using the `--rebuild` option.");
            } else {
                CommonUtils::printTruncatedError($e->getMessage());
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
}