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
            'numero_uSP' => $alunoCCEx['numero_usp'],
            'nome_aluno' => $alunoCCEx['nome_aluno'],
            'ano_nascimento' => $alunoCCEx['ano_nascimento'],
            'email' => $alunoCCEx['email'],
            'nacionalidade' => $alunoCCEx['nacionalidade'],
            'cidade_nascimento' => $alunoCCEx['cidade_nascimento'],
            'estado_nascimento' => $alunoCCEx['estado_nascimento'],
            'pais_nascimento' => $alunoCCEx['pais_nascimento'],
            'raca' => Deparas::racas[$alunoCCEx['raca']] ?? $alunoCCEx['raca'],
            'sexo' => $alunoCCEx['sexo'],
        ];

        return $properties;
    }
}