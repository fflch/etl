<?php

namespace Src\Transformation\ModelsReplicado\CredenciamentosPG;

use Src\Utils\TransformationUtils;
use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class CredenciamentoPGReplicado implements Mapper
{
    public function mapping(Array $credenciamento)
    {
        $properties = [
            'id_credenciamento' => strtoupper(
                md5(
                    $credenciamento['numero_usp'] . 
                    $credenciamento['codigo_area'] . 
                    $credenciamento['data_inicio_validade']
                )),
            'numero_usp' => $credenciamento['numero_usp'],
            'codigo_area' => $credenciamento['codigo_area'],
            'nome_area' => $credenciamento['nome_area'],
            'codigo_programa' => $credenciamento['codigo_programa'],
            'nome_programa' => $credenciamento['nome_programa'],
            'nivel' => $credenciamento['nivel'],
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