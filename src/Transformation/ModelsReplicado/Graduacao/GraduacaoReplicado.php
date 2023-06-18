<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class GraduacaoReplicado implements Mapper
{
    public function mapping(Array $graduacao)
    {
        $properties = [
            'id_graduacao' => strtoupper(md5($graduacao['numero_usp'] . $graduacao['sequencia_curso'])),
            'numero_usp' => (int)$graduacao['numero_usp'],
            'sequencia_curso' => (int)$graduacao['sequencia_curso'],
            'situacao_curso' => Deparas::situacoesGR[$graduacao['situacao_curso']] ?? $graduacao['situacao_curso'],
            'data_inicio_vinculo' => $graduacao['data_inicio_vinculo'],
            'data_fim_vinculo' => $graduacao['data_fim_vinculo'],
            'codigo_curso' => (int)$graduacao['codigo_curso'],
            'nome_curso' => $graduacao['nome_curso'],
            'tipo_ingresso' => Deparas::ingressos[$graduacao['tipo_ingresso']] ?? $graduacao['tipo_ingresso'],
            'categoria_ingresso' => $graduacao['categoria_ingresso'],
            'rank_ingresso' => $graduacao['rank_ingresso'],
            'tipo_encerramento_bacharel' => $graduacao['tipo_encerramento_bacharel'],
            'data_encerramento_bacharel' => $graduacao['data_encerramento_bacharel'],
        ];

        return $properties;
    }
}