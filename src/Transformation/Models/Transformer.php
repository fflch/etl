<?php

namespace Src\Transformation\Models;

use Src\Transformation\Models\Interfaces\Mapper;
use Src\Extraction\Replicado;

class Transformer
{
    public function __construct(Mapper $mapper, string $queryPath) {
        $this->mapper = $mapper;
        $this->queryPath = $queryPath;
    }

    public function transform()
    {
        $query = file_get_contents(__DIR__ . '/../../Extraction/Queries/' . $this->queryPath . '.sql');
        $data = Replicado::getData($query);

        $mappedData = array_map(
            function($n) {
                return $this->mapper->mapping($n);
            }, $data
        );

        return $mappedData;
    }
}