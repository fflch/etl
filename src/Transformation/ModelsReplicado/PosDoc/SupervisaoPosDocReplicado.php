<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Utils\TransformationUtils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class SupervisaoPosDocReplicado implements Mapper
{
    public function mapping(Array $supervisaoPD)
    {
        $properties = [
            'id_projeto' => $supervisaoPD['ano_projeto'] . '-' . $supervisaoPD['codigo_projeto'],
            'sequencia_supervisao' => $supervisaoPD['sequencia_supervisao'],
            'numero_usp_supervisor' => $supervisaoPD['numero_usp_supervisor'],
            'nome_supervisor' => $supervisaoPD['nome_supervisor'],
            'tipo_supervisao' => $supervisaoPD['tipo_supervisao'],
            'data_inicio_supervisao' => $supervisaoPD['data_inicio_supervisao'],
            'data_fim_supervisao' => $supervisaoPD['data_fim_supervisao'],
            'ultimo_supervisor_resp' => $supervisaoPD['ultimo_supervisor_resp'],
        ];

        return $properties;
    }
}