<?php

namespace Src\Transformation\ModelsReplicado\PosDoutorado;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class AlunoPosDoutoradoReplicado implements Mapper
{
    public function mapping(Array $alunoPosDoutorado)
    {
        $alunoPosDoutorado = Utils::emptiesToNull($alunoPosDoutorado);

        $properties = [
            'numeroUSP' => $alunoPosDoutorado['numeroUSP'],
            'nomeAluno' => $alunoPosDoutorado['nomeAluno'],
            'anoNascimento' => $alunoPosDoutorado['anoNascimento'],
            'nacionalidade' => $alunoPosDoutorado['nacionalidade'],
            'cidadeNascimento' => $alunoPosDoutorado['cidadeNascimento'],
            'estadoNascimento' => $alunoPosDoutorado['estadoNascimento'],
            'paisNascimento' => $alunoPosDoutorado['paisNascimento'],
            'raca' => Deparas::racas[$alunoPosDoutorado['raca']] ?? $alunoPosDoutorado['raca'],
            'sexo' => $alunoPosDoutorado['sexo'],
        ];

        return $properties;
    }
}