<?php

namespace Src\Transformation\ModelsReplicado;

use Src\Transformation\ModelsReplicado\Interfaces\Mapper;
use Src\Extraction\ReplicadoDB;

class Transformer
{
    public function __construct(Mapper $mapper, string $queryPath) {
        $this->mapper = $mapper;
        $this->queryPath = $queryPath;
    }

    public function transformData(array $pagination = null, array $replace = null)
    {
        $data = $this->getData($pagination, $replace);

        return $this->mapData($data);
    }

    private function getData($pagination, $replace)
    {
        $query = file_get_contents(__DIR__ . '/../../Extraction/Queries/' . $this->queryPath . '.sql');

        if(isset($pagination) || isset($replace)) {
            $query = $this->formatQuery($query, $pagination, $replace);
        }

        $data = ReplicadoDB::fetchData($query);

        return $data;
    }

    private function formatQuery(string $query, ?array $pagination, ?array $replace)
    {
        if(!is_null($replace)) {
            $query = str_replace($replace['subject'], $replace['replacement'], $query);
        }
        if(!is_null($pagination)) {
            $query .= "\n ROWS LIMIT {$pagination['limit']} OFFSET {$pagination['offset']}";
        }

        return $query;
    }

    private function mapData($data)
    {
        foreach($data as &$n) {
            $n = $this->mapper->mapping($n);
        }

        return $data;
    }
}