<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class CoordenadorPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'funcao' => $record['funcao'],
            'codigo_programa' => $record['codigo_programa'],
            'nome_programa' => $record['nome_programa'],
            'data_inicio_funcao' => $record['data_inicio_funcao'],
            'data_fim_funcao' => $record['data_fim_funcao'],
        ];

        return $properties;
    }
}
