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

    public function getData($rowLimit, $offset)
    {
        $query = file_get_contents(__DIR__ . '/../../Extraction/Queries/' . $this->queryPath . '.sql');
        $formattedQuery = $this->formatQuery($query, $rowLimit, $offset);
        $data = ReplicadoDB::fetchData($formattedQuery);

        return $data;
    }

    public function mapData($data)
    {
        foreach($data as &$n) {
            $n = $this->mapper->mapping($n);
        }

        return $data;
    }
    
    public function transformData(int $rowLimit = null, int $offset = null)
    {
        $data = $this->getData($rowLimit, $offset);

        return $this->mapData($data);
    }

    public function formatQuery($query, $rowLimit, $offset)
    {
        if(!is_null($rowLimit)) {
            $query .= "\n ROWS LIMIT {$rowLimit} OFFSET {$offset}";
        }

        return $query;
    }
}