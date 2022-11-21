<?php

namespace Src\Transformation\Models;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\Models\Interfaces\Mapper;

class AlunoGraduacaoReplicado implements Mapper
{
    public function mapping(Array $alunoGraduacao)
    {
        $alunoGraduacao = Utils::emptiesToNull($alunoGraduacao);

        $properties = [
            'numeroUSP' => $alunoGraduacao['numeroUSP'],
            'nomeAluno' => $alunoGraduacao['nomeAluno'],
            'anoNascimento' => $alunoGraduacao['anoNascimento'],
            'nacionalidade' => $alunoGraduacao['nacionalidade'],
            'cidadeNascimento' => $alunoGraduacao['cidadeNascimento'],
            'estadoNascimento' => $alunoGraduacao['estadoNascimento'],
            'paisNascimento' => $alunoGraduacao['paisNascimento'],
            'raca' => Deparas::racas[$alunoGraduacao['raca']],
            'sexo' => $alunoGraduacao['sexo'],
        ];

        return $properties;
    }
}