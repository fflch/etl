<?php

namespace Src\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;

class ExtractionUtils
{
    public static function updateTable(string $queryType, object $object, string $model)
    {
        $insertLimit = self::getInsertLimit($model);

        if ($queryType == "full") {
            $data = $object->transformData();
            foreach(array_chunk($data, $insertLimit) as $chunk) {
                $model::insert($chunk);
            }
        }
        elseif ($queryType == "paginated") {
            $pagination = ['limit' => ($insertLimit * 5), 'offset' => 0];

            do {
                $data = $object->transformData($pagination);
                foreach(array_chunk($data, ($insertLimit)) as $chunk) {
                    $model::insert($chunk);
                }

                $pagination['offset'] += $pagination['limit'];
            } while (!empty($data));
        }
        else {
            throw new \Exception(
                "Invalid value for \$queryType argument. Expected 'full' or 'paginated'."
            );
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