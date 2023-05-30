<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\TransformationUtils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class QuestionarioQuestaoReplicado implements Mapper
{
    public function mapping(Array $questao)
    {
        $properties = [
            'id_questao' => ($questao['codigo_questionario'] . "-" . $questao['codigo_questao']),
            'descricao_questao' => $questao['descricao_questao'],
            'codigo_alternativa' => $questao['codigo_alternativa'],
            'descricao_alternativa' => $questao['descricao_alternativa']
        ];

        return $properties;
    }
}