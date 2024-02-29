<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class ProficienciaIdiomaPGReplicado implements Mapper
{
    public function mapping(Array $proficiencia)
    {
        $properties = [
            'id_posgraduacao' => strtoupper(substr(
                hash('sha256',
                    $proficiencia['numero_usp'] . 
                    $proficiencia['seq_programa'] .
                    $proficiencia['codigo_area'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'idioma' => $proficiencia['idioma'],
            'data_exame' => $proficiencia['data_exame'],
        ];

        return $properties;
    }
}