<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class QuestionarioRespostaReplicado implements Mapper
{
    public function mapping(Array $resposta)
    {
        $resposta = Utils::emptiesToNull($resposta);

        $properties = [
            'id_graduacao' => strtoupper(md5($resposta['numero_usp'] . $resposta['sequencia_curso'])),
            'id_questao' => ($resposta['codigo_questionario'] . "-" . $resposta['codigo_questao']),
            'alternativa_escolhida' => $resposta['alternativa_escolhida'],

        ];

        return $properties;
    }
}