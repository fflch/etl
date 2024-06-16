<?php

namespace Src\Transformation\ReplicadoModels\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class ProjetoDiversoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_projeto_diverso' => ReplicadoModelsUtils::getProjetoDiversoId($record),
            'codigo_programa_usp' => $record['codigo_programa_usp'],
            'nome_programa_usp' => $record['nome_programa_usp'],
            'juno_projeto_programa_usp' => $record['periodo_referencial'] .
                "-" . $record['codigo_projeto_diverso'],
            'codigo_colegiado' => $record['codigo_colegiado'],
            'sigla_colegiado' => $record['sigla_colegiado'],
            'situacao_projeto' => $record['situacao_projeto'],
            'data_inicio_previsto' => $record['data_inicio_previsto'],
            'data_fim_previsto' => $record['data_fim_previsto'],
            'numero_usp_coordenador' => $record['numero_usp_coordenador'],
            'numero_bolsas_solicitadas' => $record['numero_bolsas_solicitadas'],
            'numero_bolsas_aprovadas' => $record['numero_bolsas_aprovadas'],
            'numero_participantes_nao_bolsistas' => $record['numero_participantes_nao_bolsistas'],
            'titulo_projeto' => $record['titulo_projeto'],
            'prefixo_disciplina' => $record['prefixo_disciplina'],
            'codigo_disciplina' => $record['codigo_disciplina'],
            'valor_total_projeto' => $record['valor_total_projeto'],
            'vertente_pub' => $record['vertente_pub'],
            'caracteristica_projeto' => $record['caracteristica_projeto'],
        ];

        return $properties;
    }
}
