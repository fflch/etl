<?php

namespace Src\Transformation\ReplicadoModels\Pessoas;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class PessoaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'nome' => $record['nome'],
            'data_nascimento' => $record['data_nascimento'],
            'data_falecimento' => $record['data_falecimento'],
            'email' => $record['email'],
            'nacionalidade' => $record['nacionalidade'],
            'cidade_nascimento' => $record['cidade_nascimento'],
            'estado_nascimento' => $record['estado_nascimento'],
            'pais_nascimento' => $record['pais_nascimento'],
            'raca' => Deparas::racas[$record['raca']] ?? $record['raca'],
            'sexo' => $record['sexo'],
            'orientacao_sexual' => $record['orientacao_sexual'],
            'identidade_genero' => $record['identidade_genero'],
            'situacao_vacinal_covid' => Deparas::situacoesVacinaCovid[$record['situacao_vacinal_covid']]
                ?? $record['situacao_vacinal_covid'],
            // 'cpf' => $record['cpf'],
        ];

        return $properties;
    }
}
