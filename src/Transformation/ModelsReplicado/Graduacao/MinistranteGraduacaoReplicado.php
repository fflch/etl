<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\TransformationUtils;
use Src\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class MinistranteGraduacaoReplicado implements Mapper
{
    public function mapping(Array $ministrante)
    {
        $properties = [
            'numero_usp' => $ministrante['numero_usp'],
            'codigo_disciplina' => $ministrante['codigo_disciplina'],
            'versao_disciplina' => $ministrante['versao_disciplina'],
            'codigo_turma' => $ministrante['codigo_turma'],
            'periodicidade_ministrante' => Deparas::periodicidadeProf[$ministrante['periodicidade_ministrante']] 
                                        ?? $ministrante['periodicidade_ministrante']
        ];

        return $properties;
    }
}