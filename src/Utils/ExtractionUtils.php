<?php

namespace Src\Utils;

class ExtractionUtils
{
    public static function updateTable(string $queryType, object $object, string $table, int $insertLimit)
    {
        if ($queryType == "full") {
            $data = $object->transformData();
            foreach(array_chunk($data, $insertLimit) as $chunk) {
                $table::insert($chunk);
            }
        }
        elseif ($queryType == "paginated") {
            $pagination = ['limit' => ($insertLimit * 5), 'offset' => 0];

            do {
                $data = $object->transformData($pagination);
                foreach(array_chunk($data, ($insertLimit)) as $chunk) {
                    $table::insert($chunk);
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
}