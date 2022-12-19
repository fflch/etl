<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class RespostaQuestionarioReplicado implements Mapper
{
    public function mapping(Array $resposta)
    {
        $resposta = Utils::emptiesToNull($resposta);

        $properties = [
            'idGraduacao' => strtoupper(md5($resposta['numeroUSP'] . $resposta['sequenciaCurso'])),
            'idQuestao' => ($resposta['codigoQuestionario'] . "-" . $resposta['codigoQuestao']),
            'alternativaEscolhida' => $resposta['alternativaEscolhida'],

        ];

        return $properties;
    }
}