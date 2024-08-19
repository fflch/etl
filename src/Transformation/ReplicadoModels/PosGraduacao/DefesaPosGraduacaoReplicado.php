<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class DefesaPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_defesa' => ReplicadoModelsUtils::getDefesaId($record),
            'id_posgraduacao' => ReplicadoModelsUtils::getPosGraduacaoId($record),
            'data_defesa' => $record['data_defesa'],
            'local_defesa' => CommonUtils::cleanInput(
                $record['local_defesa'],
                ['decode_html']
            ),
            'mencao_honrosa' => $record['mencao_honrosa'],
            'titulo_trabalho' => CommonUtils::cleanInput(
                $record['titulo_trabalho'],
                [
                    'decode_html',
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
        ];

        return $properties;
    }
}
