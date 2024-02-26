<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class GraduacaoReplicado implements Mapper
{
    public function mapping(Array $graduacao)
    {
        $properties = [
            'id_graduacao' => strtoupper(substr(
                hash('sha256',
                    $graduacao['numero_usp'] . 
                    $graduacao['sequencia_grad'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'numero_usp' => (int)$graduacao['numero_usp'],
            'sequencia_grad' => (int)$graduacao['sequencia_grad'],
            'situacao_curso' => Deparas::situacoesGR[$graduacao['situacao_curso']] 
                            ?? $graduacao['situacao_curso'],
            'data_inicio_vinculo' => $graduacao['data_inicio_vinculo'],
            'data_fim_vinculo' => $graduacao['data_fim_vinculo'],
            'codigo_curso' => (int)$graduacao['codigo_curso'],
            'nome_curso' => $graduacao['nome_curso'],
            'tipo_ingresso' => Deparas::ingressos[$graduacao['tipo_ingresso']] 
                            ?? $graduacao['tipo_ingresso'],
            'categoria_ingresso' => $graduacao['categoria_ingresso'],
            'rank_ingresso' => $graduacao['rank_ingresso'],
            'bacharelado' => $graduacao['bacharelado'],
            'tipo_encerramento_bacharelado' => $graduacao['tipo_encerramento_bacharelado'],
            'data_encerramento_bacharelado' => $graduacao['data_encerramento_bacharelado'],
            'licenciatura' => $graduacao['licenciatura'],
            'tipo_encerramento_licenciatura' => $graduacao['tipo_encerramento_licenciatura'],
            'data_encerramento_licenciatura' => $graduacao['data_encerramento_licenciatura'],
        ];

        return $properties;
    }
}