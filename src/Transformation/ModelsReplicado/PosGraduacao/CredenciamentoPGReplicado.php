<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class CredenciamentoPGReplicado implements Mapper
{
    public function mapping(Array $credenciamento)
    {
        $properties = [
            'id_credenciamento' => strtoupper(substr(
                hash('sha256',
                    $credenciamento['numero_usp'] . 
                    $credenciamento['codigo_area'] . 
                    $credenciamento['data_inicio_validade'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'numero_usp' => $credenciamento['numero_usp'],
            'codigo_area' => $credenciamento['codigo_area'],
            'nome_area' => $credenciamento['nome_area'],
            'codigo_programa' => $credenciamento['codigo_programa'],
            'nome_programa' => $credenciamento['nome_programa'],
            'nivel_credenciamento' => Deparas::niveisPG[$credenciamento['nivel_credenciamento']]
                        ?? $credenciamento['nivel_credenciamento'],
            'tipo_credenciamento' => Deparas::tipoCredenciamento[$credenciamento['tipo_credenciamento']] 
                                     ?? $credenciamento['tipo_credenciamento'],
            'situacao_credenciamento' => $this->checkCredenciamento($credenciamento['data_fim_validade']),
            'data_inicio_validade' => $credenciamento['data_inicio_validade'],
            'data_fim_validade' => $credenciamento['data_fim_validade'],
            'ultimo_credenciamento_area' => $credenciamento['ultimo_credenciamento_area'],
        ];

        return $properties;
    }

    private function checkCredenciamento(string $dataValidade)
    {
        $today = date("Y-m-d");

        if($dataValidade >= $today) {
            return 'Ativo';
        }
        else {
            return 'Expirado';
        }
    }
}