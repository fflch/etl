<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Interfaces\Mapper;

class QuestionarioRespostaReplicado implements Mapper
{
    public function mapping(Array $resposta)
    {
        $properties = [
            'id_graduacao' => strtoupper(substr(
                hash('sha256',
                    $resposta['numero_usp'] . 
                    $resposta['sequencia_curso'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'id_questao' => ($resposta['codigo_questionario'] . "-" . $resposta['codigo_questao']),
            'alternativa_escolhida' => $resposta['alternativa_escolhida'],

        ];

        return $properties;
    }
}