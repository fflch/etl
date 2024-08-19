<?php

namespace Src\Transformation\ReplicadoModels\QuestSocioEcon;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class QuestionarioRespostaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_graduacao' => ReplicadoModelsUtils::getGraduacaoId($record),
            'id_questao' => ReplicadoModelsUtils::getQuestaoId($record),
            'alternativa_escolhida' => $record['alternativa_escolhida'],
        ];

        return $properties;
    }
}
