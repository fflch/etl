<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;

class MinistranteCCExReplicado implements Mapper
{
    public function mapping(Array $ministranteCCEx)
    {
        $properties = [
            'numero_usp' => $ministranteCCEx['numero_usp'],
            'codigo_oferecimento' => strtoupper(md5(
                $ministranteCCEx['codigo_curso_ceu'] . 
                $ministranteCCEx['codigo_edicao_curso'] . 
                $ministranteCCEx['sequencia_oferecimento']
            )),
            'turma' => $ministranteCCEx['turma'],
            'funcao' => $ministranteCCEx['funcao'],
            'forma_exercicio' => Deparas::formasExercicioCEU[$ministranteCCEx['forma_exercicio']]
                                 ?? $ministranteCCEx['forma_exercicio'],
            'carga_horaria_horas' => $ministranteCCEx['carga_horaria_horas'],
            'data_inicio_turma' => $ministranteCCEx['data_inicio_turma'],
            'data_fim_turma' => $ministranteCCEx['data_fim_turma'],
        ];

        return $properties;
    }
}