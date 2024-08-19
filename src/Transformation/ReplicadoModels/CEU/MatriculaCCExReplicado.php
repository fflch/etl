<?php

namespace Src\Transformation\ReplicadoModels\CEU;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class MatriculaCCExReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'codigo_matricula_ceu' => $record['codigo_matricula_ceu'],
            'numero_usp' => $record['numero_usp'],
            'codigo_oferecimento' => ReplicadoModelsUtils::getOferecimentoCCExId($record),
            'data_matricula' => $record['data_matricula'],
            'situacao_matricula' => Deparas::statusMatriculaCCEx[$record['situacao_matricula']]
                ?? $record['situacao_matricula'],
            'data_inicio_curso' => $record['data_inicio_curso'],
            'data_fim_curso' => $record['data_fim_curso'],
            'frequencia_aluno' => $record['frequencia_aluno'],
            'conceito_final_aluno' => Deparas::resultadoMatriculaCCEx[$record['conceito_final_aluno']]
                ?? $record['conceito_final_aluno'],
        ];

        return $properties;
    }
}
