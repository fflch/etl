<?php

namespace Src\Transformation\ReplicadoModels\PesquisasAvancadas;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class PesquisaAvancadaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto' => ReplicadoModelsUtils::getPesquisaAvancadaId($record),
            'modalidade' => Deparas::modalidadesPD[$record['codigo_modalidade']]
                ?? 'XX',
            'numero_usp' => $record['numero_usp'],
            'situacao_projeto' => $record['situacao_projeto'],
            'data_inicio_projeto' => $record['data_inicio_projeto'],
            'data_fim_projeto' => $record['data_fim_projeto'],
            'motivo_cancelamento' => $record['motivo_cancelamento'],
            'descricao_cancelamento' => $record['descricao_cancelamento'],
            'codigo_departamento' => $record['codigo_departamento'],
            'nome_departamento' => $record['nome_departamento'],
            'titulo_projeto' => CommonUtils::cleanInput(
                $record['titulo_projeto'],
                [
                    'decode_html',
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
            'area_cnpq' => $record['area_cnpq'],
            'palavras_chave' => $this->palavrasChave(
                array(
                    $record['palcha_1'],
                    $record['palcha_2'],
                    $record['palcha_3']
                )
            ),
        ];

        return $properties;
    }

    private function palavrasChave(array $palavras)
    {
        $palavrasChave = array_filter($palavras, function ($palavra) {
            return !empty($palavra);
        });

        return CommonUtils::cleanInput(
            implode("; ", $palavrasChave),
            ['decode_html', 'to_uppercase']
        );
    }
}
