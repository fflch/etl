<?php

namespace Src\Transformation\ModelsReplicado\Pessoas;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class PessoaReplicado implements Mapper
{
    public function mapping(Array $pessoa)
    {
        $pessoa = Utils::emptiesToNull($pessoa);

        $properties = [
            'numero_usp' => $pessoa['numero_usp'],
            'nome' => $pessoa['nome'],
            'data_nascimento' => $pessoa['data_nascimento'],
            'nacionalidade' => $pessoa['nacionalidade'],
            'cidade_nascimento' => $pessoa['cidade_nascimento'],
            'estado_nascimento' => $pessoa['estado_nascimento'],
            'pais_nascimento' => $pessoa['pais_nascimento'],
            'raca' => Deparas::racas[$pessoa['raca']] ?? $pessoa['raca'],
            'sexo' => $pessoa['sexo'],
            'cpf' => $pessoa['cpf'],
        ];

        return $properties;
    }
}