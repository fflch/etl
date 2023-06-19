<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class DefesaPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $defesa)
    {
        $properties = [
            'id_posgraduacao' => strtoupper(
                md5(
                    $defesa['numero_usp'] . 
                    $defesa['seq_programa'] .
                    $defesa['codigo_area']
                )),
            'data_defesa' => $defesa['data_defesa'],
            // ver (adicionar prorrogações)
            'local_defesa' => $defesa['local_defesa'],
            'mencao_honrosa' => $defesa['mencao_honrosa'],
            'titulo_trabalho' => $defesa['titulo_trabalho'],
        ];

        return $properties;
    }
}