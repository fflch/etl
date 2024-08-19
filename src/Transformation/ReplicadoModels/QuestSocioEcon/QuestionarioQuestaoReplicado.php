<?php

namespace Src\Transformation\ReplicadoModels\QuestSocioEcon;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class QuestionarioQuestaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_questao' => ReplicadoModelsUtils::getQuestaoId($record),
            'descricao_questao' => $record['descricao_questao'],
            'codigo_alternativa' => $record['codigo_alternativa'],
            'descricao_alternativa' => $record['descricao_alternativa']
        ];

        return $properties;
    }
}
