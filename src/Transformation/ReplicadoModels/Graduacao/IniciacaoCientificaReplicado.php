<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class IniciacaoCientificaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto' => ReplicadoModelsUtils::getICId($record),
            'numero_usp' => !is_null($record['numero_usp'])
                ? (int) $record['numero_usp']
                : NULL,
            'data_inicio_projeto' => $record['data_inicio_projeto'],
            'data_fim_projeto' => $record['data_fim_projeto'],
            'situacao_projeto' => $this->checkStatus(
                $record['situacao_projeto'],
                $record['data_fim_projeto']
            ),
            'codigo_departamento' => (int) $record['codigo_departamento'],
            'nome_departamento' => $record['nome_departamento'],
            'ano_projeto' => $record['ano_projeto'],
            'numero_usp_orientador' => (int) $record['numero_usp_orientador'],
            'titulo_projeto' => CommonUtils::cleanInput(
                $record['titulo_projeto'],
                [
                    'decode_html',
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
            'palavras_chave' => CommonUtils::cleanInput(
                $record['palavras_chave'],
                [
                    'decode_html',
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
        ];

        return $properties;
    }

    private function checkStatus(string $situacao, ?string $dataFimProjeto)
    {
        $situacao = Deparas::statusProjeto[$situacao] ?? $situacao;

        $today = date("Y-m-d H:i:s");

        if (
            $situacao == 'Ativo' &&
            (strtotime($today) > strtotime($dataFimProjeto))
        ) {
            return 'Pendente';
        }

        return $situacao;
    }
}
