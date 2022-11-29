<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class AlunoPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $alunoPosGraduacao)
    {
        $alunoPosGraduacao = Utils::emptiesToNull($alunoPosGraduacao);

        $properties = [
            'numeroUSP' => $alunoPosGraduacao['numeroUSP'],
            'nomeAluno' => $alunoPosGraduacao['nomeAluno'],
            'anoNascimento' => $alunoPosGraduacao['anoNascimento'],
            'nacionalidade' => $alunoPosGraduacao['nacionalidade'],
            'cidadeNascimento' => $alunoPosGraduacao['cidadeNascimento'],
            'estadoNascimento' => $alunoPosGraduacao['estadoNascimento'],
            'paisNascimento' => $alunoPosGraduacao['paisNascimento'],
            'raca' => Deparas::racas[$alunoPosGraduacao['raca']],
            'sexo' => $alunoPosGraduacao['sexo'],
        ];

        return $properties;
    }
}