<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class AlunoPosDocReplicado implements Mapper
{
    public function mapping(Array $alunoPosDoc)
    {
        $alunoPosDoc = Utils::emptiesToNull($alunoPosDoc);

        $properties = [
            'numeroUSP' => $alunoPosDoc['numeroUSP'],
            'nomeAluno' => $alunoPosDoc['nomeAluno'],
            'anoNascimento' => $alunoPosDoc['anoNascimento'],
            'nacionalidade' => $alunoPosDoc['nacionalidade'],
            'cidadeNascimento' => $alunoPosDoc['cidadeNascimento'],
            'estadoNascimento' => $alunoPosDoc['estadoNascimento'],
            'paisNascimento' => $alunoPosDoc['paisNascimento'],
            'raca' => Deparas::racas[$alunoPosDoc['raca']] ?? $alunoPosDoc['raca'],
            'sexo' => $alunoPosDoc['sexo'],
        ];

        return $properties;
    }
}