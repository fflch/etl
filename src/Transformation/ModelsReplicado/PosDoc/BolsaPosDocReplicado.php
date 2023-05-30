<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Utils\TransformationUtils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class BolsaPosDocReplicado implements Mapper
{
    public function mapping(Array $bolsaPD)
    {
        $properties = [
            'id_projeto' => $bolsaPD['ano_projeto'] . '-' . $bolsaPD['codigo_projeto'],
            'sequencia_periodo' => $bolsaPD['sequencia_periodo'],
            'sequencia_fomento' => $bolsaPD['sequencia_fomento'],
            'codigo_fomento' => $bolsaPD['codigo_fomento'],
            'nome_fomento' => $bolsaPD['nome_fomento'],
            'data_inicio_fomento' => $bolsaPD['data_inicio_fomento'],
            'data_fim_fomento' => $bolsaPD['data_fim_fomento'],
            'id_fomento' => $bolsaPD['id_fomento'],
        ];

        return $properties;
    }
}