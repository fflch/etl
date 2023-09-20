<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

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
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'data_ocorrencia' => $ocorrenciaPG['data_ocorrencia'],
            'tipo_ocorrencia' => $ocorrenciaPG['tipo_ocorrencia'],
            'motivo_desligamento' => $ocorrenciaPG['motivo_desligamento'],
            'prazo_afastamento' => $ocorrenciaPG['prazo_afastamento'],
            'motivo_trancamento' => $ocorrenciaPG['motivo_trancamento'],
            'codigo_area_destino' => $ocorrenciaPG['codigo_area_destino'],
            'nome_area_destino' => $ocorrenciaPG['nome_area_destino'],
            'nivel_programa_destino' => $ocorrenciaPG['nivel_programa_destino'],
            'prorrogacao_solicitada_dias' => $ocorrenciaPG['prorrogacao_solicitada_dias'],
            'prorrogacao_obtida_dias' => $ocorrenciaPG['prorrogacao_obtida_dias'],
        ];

        return $properties;
    }
}