<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class DefesaPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $defesa)
    {
        $properties = [
            'id_defesa' => strtoupper(substr(
                hash('sha256',
                    'BANCA' .
                    $defesa['numero_usp'] . 
                    $defesa['seq_programa'] .
                    $defesa['codigo_area'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'id_posgraduacao' => strtoupper(substr(
                hash('sha256',
                    $defesa['numero_usp'] . 
                    $defesa['seq_programa'] .
                    $defesa['codigo_area'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'data_defesa' => $defesa['data_defesa'],
            // ver (adicionar prorrogações)
            'local_defesa' => $defesa['local_defesa'],
            'mencao_honrosa' => $defesa['mencao_honrosa'],
            'titulo_trabalho' => $defesa['titulo_trabalho'],
        ];

        return $properties;
    }
}