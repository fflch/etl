<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;

class DefesaPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $defesa)
    {
        $properties = [
            'id_defesa' => strtoupper(substr(
                hash('sha256',
                    'DEFESA' .
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
            // ver (adicionar prorrogações de defesa e cf datas de prorrogação do programa)
            'local_defesa' => CommonUtils::cleanInput(
                $defesa['local_defesa'],
                ['decode_html']
            ),
            'mencao_honrosa' => $defesa['mencao_honrosa'],
            'titulo_trabalho' => CommonUtils::cleanInput(
                $defesa['titulo_trabalho'],
                [
                    'decode_html',
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
        ];

        return $properties;
    }
}