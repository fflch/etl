<?php

namespace Src\Transformation\ModelsReplicado\Pessoas;

use Src\Utils\TransformationUtils;
use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class PessoaReplicado implements Mapper
{
    public function mapping(Array $pessoa)
    {
        $properties = [
            'numero_usp' => $pessoa['numero_usp'],
            'nome' => $pessoa['nome'],
            'data_nascimento' => $pessoa['data_nascimento'],
            'data_falecimento' => $pessoa['data_falecimento'],
            'email' => $pessoa['email'],
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