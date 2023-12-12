<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;

class OcorrenciaPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $ocorrenciaPG)
    {
        $properties = [
            'id_posgraduacao' => strtoupper(substr(
                hash('sha256',
                    $ocorrenciaPG['numero_usp'] . 
                    $ocorrenciaPG['seq_programa'] .
                    $ocorrenciaPG['codigo_area'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'data_ocorrencia' => $ocorrenciaPG['data_ocorrencia'],
            'tipo_ocorrencia' => $ocorrenciaPG['tipo_ocorrencia'],
            'motivo_ocorrencia' => $ocorrenciaPG['motivo_ocorrencia'],
            'prazo_afastamento' => $ocorrenciaPG['prazo_afastamento'],
            'codigo_area_destino' => $ocorrenciaPG['codigo_area_destino'],
            'nome_area_destino' => $ocorrenciaPG['nome_area_destino'],
            'nivel_programa_destino' => Deparas::niveisPG[$ocorrenciaPG['nivel_programa_destino']]
                                        ?? $ocorrenciaPG['nivel_programa_destino'],
            'prorrogacao_def_solicitada_dias' => $ocorrenciaPG['prorrogacao_def_solicitada_dias'],
            'prorrogacao_def_obtida_dias' => $ocorrenciaPG['prorrogacao_def_obtida_dias'],
        ];

        return $properties;
    }
}