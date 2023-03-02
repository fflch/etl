<?php

namespace Src\Transformation\ModelsReplicado\Servidores;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class ServidorReplicado implements Mapper
{
    public function mapping(Array $servidor)
    {
        $servidor = Utils::emptiesToNull($servidor);

        $properties = [
            'numero_usp' => $servidor['numero_usp'],
            'nome_aluno' => $servidor['nome_aluno'],
            'ano_nascimento' => $servidor['ano_nascimento'],
            'nacionalidade' => $servidor['nacionalidade'],
            'cidade_nascimento' => $servidor['cidade_nascimento'],
            'estado_nascimento' => $servidor['estado_nascimento'],
            'pais_nascimento' => $servidor['pais_nascimento'],
            'raca' => Deparas::racas[$servidor['raca']] ?? $servidor['raca'],
            'sexo' => $servidor['sexo'],
        ];

        return $properties;
    }
}