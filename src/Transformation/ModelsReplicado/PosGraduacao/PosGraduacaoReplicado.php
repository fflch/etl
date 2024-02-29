<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;

class PosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $posGraduacao)
    {
        $properties = [
            'id_posgraduacao' => strtoupper(substr(
                hash('sha256',
                    $posGraduacao['numero_usp'] . 
                    $posGraduacao['seq_programa'] .
                    $posGraduacao['codigo_area'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'numero_usp' => $posGraduacao['numero_usp'],
            'seq_programa' => $posGraduacao['seq_programa'],
            'tipo_matricula' => Deparas::tiposMatriculaPG[$posGraduacao['tipo_matricula']] 
                                ?? $posGraduacao['tipo_matricula'],
            'nivel_programa' => Deparas::niveisPG[$posGraduacao['nivel_programa']]
                                ?? $posGraduacao['nivel_programa'],
            'codigo_area' => $posGraduacao['codigo_area'],
            'nome_area' => $posGraduacao['nome_area'],
            'codigo_programa' => $posGraduacao['codigo_programa'],
            'nome_programa' => $posGraduacao['nome_programa'],
            'data_selecao' => $posGraduacao['data_selecao'],
            'primeira_matricula' => $posGraduacao['primeira_matricula'],
            'tipo_ultima_ocorrencia' => $posGraduacao['tipo_ultima_ocorrencia'],
            'data_ultima_ocorrencia' => $posGraduacao['data_ultima_ocorrencia'],
            'data_deposito_trabalho' => $posGraduacao['data_deposito_trabalho'],
            'data_aprovacao_trabalho' => $posGraduacao['data_aprovacao_trabalho'],
        ];

        return $properties;
    }
}