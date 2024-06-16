<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class IntercambioGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_graduacao' => ReplicadoModelsUtils::getGraduacaoId($record),
            'numero_usp' => $record['numero_usp'],
            'modalidade_intercambio' => Deparas::modalidadesIntercambio[$record['modalidade_intercambio']]
                ?? $record['modalidade_intercambio'],
            'data_inicio_intercambio' => $record['data_inicio_intercambio'],
            'data_fim_intercambio' => $record['data_fim_intercambio'],
            'situacao_intercambio' => $record['situacao_intercambio'],
            'data_desistencia' => $record['data_desistencia'],
            'houve_prorrogacao' => $record['houve_prorrogacao'],
            'codigo_instituicao' => $record['codigo_instituicao'],
            'sigla_instituicao' => $record['sigla_instituicao'],
            'nome_instituicao' => $record['nome_instituicao'],
            'tipo_ingresso_intercambio' => Deparas::tiposIngressoIntercambio[$record['tipo_ingresso_intercambio']]
                ?? $record['tipo_ingresso_intercambio'],
            'codigo_edital_intercambio' => $record['codigo_edital_intercambio'],
            'nome_programa_intercambio' => $record['nome_programa_intercambio'],
            'nome_rede_intercambio' => $record['nome_rede_intercambio'],
        ];

        return $properties;
    }
}
