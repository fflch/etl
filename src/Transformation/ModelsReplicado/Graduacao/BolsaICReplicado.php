<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\TransformationUtils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class BolsaICReplicado implements Mapper
{
    public function mapping(Array $bolsaIC)
    {
        $properties = [
            'id_projeto' => ($bolsaIC['ano_projeto'] . '-' . $bolsaIC['codigo_projeto']),
            'sequencia_fomento' => $bolsaIC['sequencia_fomento'],
            'nome_fomento' => $bolsaIC['nome_fomento'],
            'fomento_edital' => $bolsaIC['fomento_edital'],
            'data_inicio_fomento' => $bolsaIC['data_inicio_fomento'],
            'data_fim_fomento' => $bolsaIC['data_fim_fomento'],
        ];

        return $properties;
    }
}