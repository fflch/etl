<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class MinistrantePosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $ministrantePG)
    {
        $properties = [
            'numero_usp' => $ministrantePG['numero_usp'],
            'id_turma' => strtoupper(
                md5(
                    $ministrantePG['codigo_disciplina'] . 
                    $ministrantePG['versao_disciplina'] . 
                    $ministrantePG['codigo_turma']
                ))
        ];

        return $properties;
    }
}