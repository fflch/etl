<?php

namespace Src\Transformation\ReplicadoModels\Servidores;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class ProfessorVisitanteReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'data_inicio_intercambio' => $record['data_inicio_intercambio'],
            'data_fim_intercambio' => $record['data_fim_intercambio'],
            'tipo_intercambio' => $record['tipo_intercambio'],
            'codigo_instituicao_origem' => $record['codigo_instituicao_origem'],
            'sigla_instituicao_origem' => $record['sigla_instituicao_origem'],
            'nome_instituicao_origem' => $record['nome_instituicao_origem'],
            'tipo_ingresso_intercambio' => Deparas::tiposIngressoIntercambio[$record['tipo_ingresso_intercambio']]
                ?? $record['tipo_ingresso_intercambio'],
            'nome_programa_intercambio' => $record['nome_programa_intercambio'],
            'nome_rede_intercambio' => $record['nome_rede_intercambio'],
            'responsavel_numero_usp' => $record['responsavel_numero_usp'],
            'responsavel_unidade' => $record['responsavel_unidade'],
            'responsavel_codigo_setor' => $record['responsavel_codigo_setor'],
            'responsavel_nome_setor' => $record['responsavel_nome_setor'],
        ];

        return $properties;
    }
}
