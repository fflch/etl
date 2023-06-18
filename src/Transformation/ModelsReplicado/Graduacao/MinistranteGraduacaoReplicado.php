<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class MinistranteGraduacaoReplicado implements Mapper
{
    public function mapping(Array $ministrante)
    {
        $properties = [
            'numero_usp' => $ministrante['numero_usp'],
            'id_turma' => strtoupper(
                md5(
                    $ministrante['codigo_disciplina'] . 
                    $ministrante['versao_disciplina'] . 
                    $ministrante['codigo_turma']
                )),
            'periodicidade_ministrante' => Deparas::periodicidadeProf[$ministrante['periodicidade_ministrante']] 
                                        ?? $ministrante['periodicidade_ministrante']
        ];

        return $properties;
    }
}