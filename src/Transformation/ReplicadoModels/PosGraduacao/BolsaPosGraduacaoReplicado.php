<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class BolsaPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_bolsa' => ReplicadoModelsUtils::getBolsaPosGraduacaoId($record),
            'id_posgraduacao' => ReplicadoModelsUtils::getPosGraduacaoId($record),
            'situacao_bolsa' => $record['situacao_bolsa'],
            'data_inicio_bolsa' => $record['data_inicio_bolsa'],
            'data_fim_bolsa' => $record['data_fim_bolsa'],
            'codigo_instituicao_fomento' => $record['codigo_instituicao_fomento'],
            'sigla_instituicao_fomento' => $record['sigla_instituicao_fomento'],
            'nome_instituicao_fomento' => CommonUtils::cleanInput(
                $record['nome_instituicao_fomento'],
                ['decode_html']
            ),
            'codigo_programa_fomento' => $record['codigo_programa_fomento'],
            'nome_programa_fomento' => CommonUtils::cleanInput(
                $record['nome_programa_fomento'],
                ['remove_trailing_periods', 'trim_quotes']
            ),
        ];

        return $properties;
    }
}
