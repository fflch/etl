<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class MatriculaCCExReplicado implements Mapper
{
    public function mapping(Array $matriculaCCEx)
    {
        $matriculaCCEx = Utils::emptiesToNull($matriculaCCEx);

        $properties = [
            'codigoMatriculaCEU' => $matriculaCCEx['codigoMatriculaCEU'],
            'numeroUSP' => $matriculaCCEx['numeroUSP'],
            'codigoOferecimento' => strtoupper(md5(
                                        $matriculaCCEx['codigoCursoCEU'] . 
                                        $matriculaCCEx['codigoEdicaoCurso'] . 
                                        $matriculaCCEx['sequenciaOferecimento']
                                    )),
            'dataMatricula' => $matriculaCCEx['dataMatricula'],
            'statusMatricula' => $matriculaCCEx['statusMatricula'],
            'dataInicioCurso' => $matriculaCCEx['dataInicioCurso'],
            'dataFimCurso' => $matriculaCCEx['dataFimCurso'],
            'frequenciaAluno' => $matriculaCCEx['frequenciaAluno'],
            'conceitoFinalAluno' => $matriculaCCEx['conceitoFinalAluno'],
        ];

        return $properties;
    }
}