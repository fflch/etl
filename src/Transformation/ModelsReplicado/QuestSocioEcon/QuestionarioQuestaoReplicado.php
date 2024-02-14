<?php

namespace Src\Transformation\ModelsReplicado\QuestSocioEcon;

use Src\Transformation\Interfaces\Mapper;

class QuestionarioQuestaoReplicado implements Mapper
{
    public function mapping(Array $questao)
    {
        $properties = [
            'id_questao' => ($questao['codigo_questionario'] . 
                            "-" . 
                            str_pad($questao['codigo_questao'], 2, 0, STR_PAD_LEFT)),
            'descricao_questao' => $questao['descricao_questao'],
            'codigo_alternativa' => $questao['codigo_alternativa'],
            'descricao_alternativa' => $questao['descricao_alternativa']
        ];

        return $properties;
    }
}