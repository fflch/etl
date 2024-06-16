<?php

namespace Src\Transformation\ModelsReplicado\Servidores;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class DesignacaoServidorReplicado implements Mapper
{
    public function mapping(array $designacao)
    {
        $properties = [
            'id_vinculo' => strtoupper(
                substr(
                    hash(
                        'sha256',
                        $designacao['numero_usp'] .
                            $designacao['sequencia_vinculo'] .
                            $designacao['vinculo'] .
                            $_ENV['ETL_HASH_PEPPER']
                    ),
                    0,
                    32
                )
            ),
            'data_inicio_designacao' => $designacao['data_inicio_designacao'],
            'data_fim_designacao' => $designacao['data_fim_designacao'],
            'codigo_setor_designacao' => $designacao['codigo_setor_designacao'],
            'nome_setor_designacao' => $designacao['nome_setor_designacao'],
            'nome_funcao' => $designacao['nome_funcao'],
            'tipo_designacao' => Deparas::tiposDesignacaoServidor[$designacao['tipo_designacao']]
                ?? $designacao['tipo_designacao'],
        ];

        return $properties;
    }
}
