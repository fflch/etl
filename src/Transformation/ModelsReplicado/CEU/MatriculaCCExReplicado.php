<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class MatriculaCCExReplicado implements Mapper
{
    public function mapping(Array $matriculaCCEx)
    {
        $properties = [
            'codigo_matricula_ceu' => $matriculaCCEx['codigo_matricula_ceu'],
            'numero_usp' => $matriculaCCEx['numero_usp'],
            'codigo_oferecimento' => strtoupper(md5(
                                        $matriculaCCEx['codigo_curso_ceu'] . 
                                        $matriculaCCEx['codigo_edicao_curso'] . 
                                        $matriculaCCEx['sequencia_oferecimento']
                                    )),
            'data_matricula' => $matriculaCCEx['data_matricula'],
            'status_matricula' => Deparas::statusMatriculaCCEx[$matriculaCCEx['status_matricula']]
                                  ?? $matriculaCCEx['status_matricula'],
            'data_inicio_curso' => $matriculaCCEx['data_inicio_curso'],
            'data_fim_curso' => $matriculaCCEx['data_fim_curso'],
            'frequencia_aluno' => $matriculaCCEx['frequencia_aluno'],
            'conceito_final_aluno' => Deparas::resultadoMatriculaCCEx[$matriculaCCEx['conceito_final_aluno']]
                                      ?? $matriculaCCEx['conceito_final_aluno'],
        ];

        return $properties;
    }
}