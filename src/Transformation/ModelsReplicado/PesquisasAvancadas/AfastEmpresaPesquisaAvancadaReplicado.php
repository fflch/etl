<?php

namespace Src\Transformation\ModelsReplicado\PesquisasAvancadas;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;

class AfastEmpresaPesquisaAvancadaReplicado implements Mapper
{
    public function mapping(Array $afastamento)
    {
        $properties = [
            'id_projeto' => $afastamento['ano_projeto'] . '-' . $afastamento['codigo_projeto'],
            'sequencia_periodo' => $afastamento['sequencia_periodo'],
            'seq_vinculo_empresa' => $afastamento['seq_vinculo_empresa'],
            'nome_empresa' => CommonUtils::cleanInput(
                $afastamento['nome_empresa'],
                ['decode_html']
            ),
            'data_inicio_afastamento' => $afastamento['data_inicio_afastamento'],
            'data_fim_afastamento' => $afastamento['data_fim_afastamento'],
            'tipo_vinculo' => Deparas::tiposVinculoPD[$afastamento['tipo_vinculo']] ?? $afastamento['tipo_vinculo'],
        ];

        return $properties;
    }
}