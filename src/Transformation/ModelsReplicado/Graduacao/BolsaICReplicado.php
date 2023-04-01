<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class BolsaICReplicado implements Mapper
{
    public function mapping(Array $bolsaIC)
    {
        $bolsaIC = Utils::emptiesToNull($bolsaIC);

        $properties = [
            'id_projeto' => ($bolsaIC['ano_projeto'] . '-' . $bolsaIC['codigo_projeto']),
            'sequencia_bolsa' => $bolsaIC['sequencia_bolsa'],
            'nome_programa' => $bolsaIC['nome_programa'],
            'bolsa_edital' => $bolsaIC['bolsa_edital'],
            'data_inicio_bolsa' => $bolsaIC['data_inicio_bolsa'],
            'data_fim_bolsa' => $bolsaIC['data_fim_bolsa'],
        ];

        return $properties;
    }
}