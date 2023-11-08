<?php

namespace Src\Transformation\ModelsReplicado\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;

class ProjetoDiversoReplicado implements Mapper
{
    public function mapping(Array $projeto)
    {
        $properties = [
            'id_projeto_diverso' => strtoupper(substr(md5(
                $projeto['codigo_programa_usp'] . 
                $projeto['sequencia_programa_usp'] . 
                $projeto['periodo_referencial'] . 
                $projeto['codigo_projeto_diverso']
                ), 0, 12)
            ),
            'codigo_programa_usp' => $projeto['codigo_programa_usp'],
            'nome_programa_usp' => $projeto['nome_programa_usp'],
            'juno_projeto_programa_usp' => $projeto['periodo_referencial']
                                        . "-" 
                                        . $projeto['codigo_projeto_diverso'],
            'codigo_colegiado' => $projeto['codigo_colegiado'],
            'sigla_colegiado' => $projeto['sigla_colegiado'],
            'situacao_projeto' => $projeto['situacao_projeto'],
            'data_inicio_previsto' => $projeto['data_inicio_previsto'],
            'data_fim_previsto' => $projeto['data_fim_previsto'],
            'numero_usp_coordenador' => $projeto['numero_usp_coordenador'],
            'numero_bolsas_solicitadas' => $projeto['numero_bolsas_solicitadas'],
            'numero_bolsas_aprovadas' => $projeto['numero_bolsas_aprovadas'],
            'numero_participantes_nao_bolsistas' => $projeto['numero_participantes_nao_bolsistas'],
            'titulo_projeto' => $projeto['titulo_projeto'],
            'prefixo_disciplina' => $projeto['prefixo_disciplina'],
            'codigo_disciplina' => $projeto['codigo_disciplina'],
            'valor_total_projeto' => $projeto['valor_total_projeto'],
            'vertente_pub' => $projeto['vertente_pub'],
            'caracteristica_projeto' => $projeto['caracteristica_projeto'],
        ];

        return $properties;
    }
}