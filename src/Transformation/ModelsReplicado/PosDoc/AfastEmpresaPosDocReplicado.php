<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Utils\TransformationUtils;
use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class AfastEmpresaPosDocReplicado implements Mapper
{
    public function mapping(Array $afastamento)
    {
        $properties = [
            'id_projeto' => $afastamento['ano_projeto'] . '-' . $afastamento['codigo_projeto'],
            'sequencia_periodo' => $afastamento['sequencia_periodo'],
            'seq_vinculo_empresa' => $afastamento['seq_vinculo_empresa'],
            'nome_empresa' => $afastamento['nome_empresa'],
            'data_inicio_afastamento' => $afastamento['data_inicio_afastamento'],
            'data_fim_afastamento' => $afastamento['data_fim_afastamento'],
            'tipo_vinculo' => Deparas::tiposVinculoPD[$afastamento['tipo_vinculo']] ?? $afastamento['tipo_vinculo'],
        ];

        return $properties;
    }
}