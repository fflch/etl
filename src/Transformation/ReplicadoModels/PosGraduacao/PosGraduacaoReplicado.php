<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class PosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_posgraduacao' => ReplicadoModelsUtils::getPosGraduacaoId($record),
            'numero_usp' => $record['numero_usp'],
            'seq_programa' => $record['seq_programa'],
            'tipo_matricula' => Deparas::tiposMatriculaPG[$record['tipo_matricula']]
                ?? $record['tipo_matricula'],
            'nivel_programa' => Deparas::niveisPG[$record['nivel_programa']]
                ?? $record['nivel_programa'],
            'codigo_area' => $record['codigo_area'],
            'nome_area' => $record['nome_area'],
            'codigo_programa' => $record['codigo_programa'],
            'nome_programa' => $record['nome_programa'],
            'data_selecao' => $record['data_selecao'],
            'data_primeira_matricula' => $record['data_primeira_matricula'],
            'tipo_ultima_ocorrencia' => $record['tipo_ultima_ocorrencia'],
            'data_ultima_ocorrencia' => $record['data_ultima_ocorrencia'],
            'data_deposito_trabalho' => $record['data_deposito_trabalho'],
            'data_aprovacao_trabalho' => $record['data_aprovacao_trabalho'],
        ];

        return $properties;
    }
}
