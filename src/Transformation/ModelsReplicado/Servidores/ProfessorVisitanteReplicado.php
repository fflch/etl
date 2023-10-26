<?php

namespace Src\Transformation\ModelsReplicado\Servidores;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class ProfessorVisitanteReplicado implements Mapper
{
    public function mapping(Array $professor)
    {
        $properties = [
            'numero_usp' => $professor['numero_usp'],
            'data_inicio_intercambio' => $professor['data_inicio_intercambio'],
            'data_fim_intercambio' => $professor['data_fim_intercambio'],
            'tipo_intercambio' => $professor['tipo_intercambio'],
            'codigo_instituicao_origem' => $professor['codigo_instituicao_origem'],
            'sigla_instituicao_origem' => $professor['sigla_instituicao_origem'],
            'nome_instituicao_origem' => $professor['nome_instituicao_origem'],
            'tipo_ingresso_intercambio' => Deparas::tiposIngressoIntercambio[$professor['tipo_ingresso_intercambio']]
                                        ?? $professor['tipo_ingresso_intercambio'],
            'nome_programa_intercambio' => $professor['nome_programa_intercambio'],
            'nome_rede_intercambio' => $professor['nome_rede_intercambio'],
            'responsavel_numero_usp' => $professor['responsavel_numero_usp'],
            'responsavel_unidade' => $professor['responsavel_unidade'],
            'responsavel_codigo_setor' => $professor['responsavel_codigo_setor'],
            'responsavel_nome_setor' => $professor['responsavel_nome_setor'],
        ];

        return $properties;
    }
}