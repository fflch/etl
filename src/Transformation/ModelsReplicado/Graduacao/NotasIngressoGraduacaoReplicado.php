<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Interfaces\Mapper;

class NotasIngressoGraduacaoReplicado implements Mapper
{
    public function mapping(Array $notaIngresso)
    {
        $properties = [
            'id_graduacao' => strtoupper(substr(
                hash('sha256',
                    $notaIngresso['numero_usp'] . 
                    $notaIngresso['sequencia_grad'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'codigo_prova' => $notaIngresso['codigo_prova'],
            'descricao_prova' => $notaIngresso['descricao_prova'],
            'pontos_obtidos' => $notaIngresso['pontos_obtidos'], 
            'pontos_maximo' => $notaIngresso['pontos_maximo'],
        ];

        return $properties;
    }
}