<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

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
            'raca' => Deparas::racas[$alunoGraduacao['raca']] ?? $alunoGraduacao['raca'],
            'sexo' => $alunoGraduacao['sexo'],
        ];

        return $properties;
    }
}