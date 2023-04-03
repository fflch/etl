<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class MinistranteCCExReplicado implements Mapper
{
    public function mapping(Array $ministranteCCEx)
    {
        $ministranteCCEx = Utils::emptiesToNull($ministranteCCEx);

        $properties = [
            'numero_usp' => $ministranteCCEx['numero_usp'],
            'codigo_oferecimento' => strtoupper(
                                        md5(
                                            $ministranteCCEx['codigo_curso_ceu'] . 
                                            $ministranteCCEx['codigo_edicao_curso'] . 
                                            $ministranteCCEx['sequencia_oferecimento']
                                        )
                                    ),
            'turma' => $ministranteCCEx['turma'],
            'funcao' => $ministranteCCEx['funcao'],
            'forma_exercicio' => $ministranteCCEx['forma_exercicio'],
            'carga_horaria_minutos' => $ministranteCCEx['carga_horaria_minutos'], //ver
            'data_inicio_turma' => $ministranteCCEx['data_inicio_turma'],
            'data_fim_turma' => $ministranteCCEx['data_fim_turma'],
        ];

        return $properties;
    }
}