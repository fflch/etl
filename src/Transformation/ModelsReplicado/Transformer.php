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

    public function transform(array $orderBy = NULL)
    {
        $query = file_get_contents(__DIR__ . '/../../Extraction/Queries/' . $this->queryPath . '.sql');
        $data = ReplicadoDB::getData($query);

        if(!empty($orderBy)){
            $data = $this->order($data, $orderBy);
        }

        $mappedData = array_map(
            function($n) {
                return $this->mapper->mapping($n);
            }, $data
        );

        return $mappedData;
    }

    public function order(array $data, array $orderBy)
    {
        $aux = [];

        foreach ($data as &$row) {
            $combined = "";
            foreach($orderBy as $attr){
                $combined .= $row[$attr];
            }
            $aux[$combined] = isset($aux[$combined])
                              ? $aux[$combined] + 1
                              : 1;

            $row['order'] = $aux[$combined];
        }

        return($data);
    }
}