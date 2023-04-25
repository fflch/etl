<?php

namespace Src\Transformation\ModelsReplicado\Servidores;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class DesignacaoServidorReplicado implements Mapper
{
    public function mapping(Array $designacao)
    {
        $designacao = Utils::emptiesToNull($designacao);

        $properties = [
            'id_vinculo' => strtoupper(
                md5(
                    $designacao['numero_usp'] . 
                    $designacao['sequencia_vinculo'] . 
                    $designacao['vinculo']
                )
            ),
            'numero_usp' => $designacao['numero_usp'],
            'vinculo' => Deparas::tiposVinculoServidores[$designacao['vinculo']] ?? $designacao['vinculo'],
            'data_inicio_designacao' => $designacao['data_inicio_designacao'],
            'data_fim_designacao' => $designacao['data_fim_designacao'],
            'codigo_setor_designacao' => $designacao['codigo_setor_designacao'],
            'nome_setor_designacao' => $designacao['nome_setor_designacao'],
            'nome_funcao' => $designacao['nome_funcao'],
            'tipo_designacao' => $designacao['tipo_designacao'],
        ];

        return $properties;
    }
}