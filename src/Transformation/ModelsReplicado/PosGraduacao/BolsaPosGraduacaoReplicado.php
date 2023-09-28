<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class BolsaPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $bolsaPG)
    {
        $properties = [
            'id_bolsa' => strtoupper(substr(
                hash('sha256',
                    $bolsaPG['codigo_instituicao_fomento'] . "." .
                    $bolsaPG['codigo_programa_fomento'] . "." .
                    $bolsaPG['codigo_bolsa_fomento']
                ), 0, 12)
            ),
            'id_posgraduacao' => strtoupper(substr(
                hash('sha256',
                    $bolsaPG['numero_usp'] . 
                    $bolsaPG['seq_programa'] .
                    $bolsaPG['codigo_area'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'situacao_bolsa' => $bolsaPG['situacao_bolsa'],
            'data_inicio_bolsa' => $bolsaPG['data_inicio_bolsa'],
            'data_fim_bolsa' => $bolsaPG['data_fim_bolsa'],
            'codigo_instituicao_fomento' => $bolsaPG['codigo_instituicao_fomento'],
            'sigla_instituicao_fomento' => $bolsaPG['sigla_instituicao_fomento'],
            'nome_instituicao_fomento' => $bolsaPG['nome_instituicao_fomento'],
            'codigo_programa_fomento' => $bolsaPG['codigo_programa_fomento'],
            'nome_programa_fomento' => $bolsaPG['nome_programa_fomento'],
        ];

        return $properties;
    }
}