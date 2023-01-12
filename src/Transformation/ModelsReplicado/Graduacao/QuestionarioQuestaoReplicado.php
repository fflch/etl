<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class QuestionarioQuestaoReplicado implements Mapper
{
    public function mapping(Array $questao)
    {
        $questao = Utils::emptiesToNull($questao);

        $properties = [
            'idQuestao' => ($questao['codigoQuestionario'] . "-" . $questao['codigoQuestao']),
            'descricaoQuestao' => $questao['descricaoQuestao'],
            'codigoAlternativa' => $questao['codigoAlternativa'],
            'descricaoAlternativa' => $questao['descricaoAlternativa']
        ];

        return $properties;
    }
}