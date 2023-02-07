<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class AlunoCCExReplicado implements Mapper
{
    public function mapping(Array $alunoCCEx)
    {
        $alunoCCEx = Utils::emptiesToNull($alunoCCEx);

        $properties = [
            'numeroUSP' => $alunoCCEx['numeroUSP'],
            'nomeAluno' => $alunoCCEx['nomeAluno'],
            'anoNascimento' => $alunoCCEx['anoNascimento'],
            'email' => $alunoCCEx['email'],
            'nacionalidade' => $alunoCCEx['nacionalidade'],
            'cidadeNascimento' => $alunoCCEx['cidadeNascimento'],
            'estadoNascimento' => $alunoCCEx['estadoNascimento'],
            'paisNascimento' => $alunoCCEx['paisNascimento'],
            'raca' => Deparas::racas[$alunoCCEx['raca']] ?? $alunoCCEx['raca'],
            'sexo' => $alunoCCEx['sexo'],
        ];

        return $properties;
    }
}