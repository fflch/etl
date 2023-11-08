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
                    $resposta['sequencia_grad'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'id_questao' => ($resposta['codigo_questionario'] .
                            "-" . 
                            str_pad($resposta['codigo_questao'], 2, 0, STR_PAD_LEFT)),
            'alternativa_escolhida' => $resposta['alternativa_escolhida'],

        ];

        return $properties;
    }
}