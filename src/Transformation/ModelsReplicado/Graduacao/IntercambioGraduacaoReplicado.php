<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class IntercambioGraduacaoReplicado implements Mapper
{
    public function mapping(Array $intercambioGrad)
    {
        $properties = [
            'id_graduacao' => strtoupper(substr(
                hash('sha256',
                    $intercambioGrad['numero_usp'] . 
                    $intercambioGrad['sequencia_grad'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'numero_usp' => $intercambioGrad['numero_usp'],
            'modalidade_intercambio' => Deparas::modalidadesIntercambio[$intercambioGrad['modalidade_intercambio']]
                                        ?? $intercambioGrad['modalidade_intercambio'],
            'data_inicio_intercambio' => $intercambioGrad['data_inicio_intercambio'],
            'data_fim_intercambio' => $intercambioGrad['data_fim_intercambio'],
            'situacao_intercambio' => $intercambioGrad['situacao_intercambio'],
            'data_desistencia' => $intercambioGrad['data_desistencia'],
            'houve_prorrogacao' => $intercambioGrad['houve_prorrogacao'],
            'codigo_instituicao' => $intercambioGrad['codigo_instituicao'],
            'sigla_instituicao' => $intercambioGrad['sigla_instituicao'],
            'nome_instituicao' => $intercambioGrad['nome_instituicao'],
            'tipo_ingresso_intercambio' => Deparas::tiposIngressoIntercambio[$intercambioGrad['tipo_ingresso_intercambio']]
                            ?? $intercambioGrad['tipo_ingresso_intercambio'],
            'codigo_edital_intercambio' => $intercambioGrad['codigo_edital_intercambio'],
            'nome_programa_intercambio' => $intercambioGrad['nome_programa_intercambio'],
            'nome_rede_intercambio' => $intercambioGrad['nome_rede_intercambio'],
        ];

        return $properties;
    }
}