<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class PosGraduacaoConveniadaReplicado implements Mapper
{
    public function mapping(Array $conveniado)
    {
        $properties = [
            'id_posgraduacao' => strtoupper(substr(
                hash('sha256',
                    $conveniado['numero_usp'] . 
                    $conveniado['seq_programa'] .
                    $conveniado['codigo_area'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'codigo_convenio' => $conveniado['codigo_convenio'],
            'sigla_convenio' => $conveniado['sigla_convenio'],
            'nome_convenio' =>$conveniado['nome_convenio'],
        ];

        return $properties;
    }
}