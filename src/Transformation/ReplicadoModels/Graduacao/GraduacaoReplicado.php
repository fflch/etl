<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class GraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_graduacao' => ReplicadoModelsUtils::getGraduacaoId($record),
            'numero_usp' => (int)$record['numero_usp'],
            'sequencia_grad' => (int)$record['sequencia_grad'],
            'situacao_curso' => Deparas::situacoesGR[$record['situacao_curso']]
                ?? $record['situacao_curso'],
            'data_inicio_vinculo' => $record['data_inicio_vinculo'],
            'data_fim_vinculo' => $record['data_fim_vinculo'],
            'codigo_curso' => (int)$record['codigo_curso'],
            'nome_curso' => $record['nome_curso'],
            'tipo_ingresso' => Deparas::ingressos[$record['tipo_ingresso']]
                ?? $record['tipo_ingresso'],
            'categoria_ingresso' => $record['categoria_ingresso'],
            'rank_ingresso' => $record['rank_ingresso'],
            'bacharelado' => $record['bacharelado'],
            'tipo_encerramento_bacharelado' => $record['tipo_encerramento_bacharelado'],
            'data_encerramento_bacharelado' => $record['data_encerramento_bacharelado'],
            'licenciatura' => $record['licenciatura'],
            'tipo_encerramento_licenciatura' => $record['tipo_encerramento_licenciatura'],
            'data_encerramento_licenciatura' => $record['data_encerramento_licenciatura'],
        ];

        return $properties;
    }
}
