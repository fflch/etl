<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class CredenciamentoPGReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_credenciamento' => ReplicadoModelsUtils::getCredenciamentoId($record),
            'numero_usp' => $record['numero_usp'],
            'codigo_area' => $record['codigo_area'],
            'nome_area' => $record['nome_area'],
            'codigo_programa' => $record['codigo_programa'],
            'nome_programa' => $record['nome_programa'],
            'nivel_credenciamento' => Deparas::niveisPG[$record['nivel_credenciamento']]
                ?? $record['nivel_credenciamento'],
            'tipo_credenciamento' => Deparas::tipoCredenciamento[$record['tipo_credenciamento']]
                ?? $record['tipo_credenciamento'],
            'situacao_credenciamento' => $this->checkCredenciamento($record['data_fim_validade']),
            'data_inicio_validade' => $record['data_inicio_validade'],
            'data_fim_validade' => $record['data_fim_validade'],
            'ultimo_credenciamento_area' => $record['ultimo_credenciamento_area'],
        ];

        return $properties;
    }

    private function checkCredenciamento(string $dataValidade)
    {
        $today = date("Y-m-d");

        if ($dataValidade >= $today) {
            return 'Ativo';
        } else {
            return 'Expirado';
        }
    }
}
