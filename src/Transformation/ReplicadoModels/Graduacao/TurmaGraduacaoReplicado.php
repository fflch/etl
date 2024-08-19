<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class TurmaGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_turma' => ReplicadoModelsUtils::getTurmaGraduacaoId($record),
            'id_disciplina' => ReplicadoModelsUtils::getDisciplinaGraduacaoId($record),
            'codigo_turma' => $record['codigo_turma'],
            'tipo_turma' => $record['tipo_turma'],
            'data_criacao_turma' => $record['data_criacao_turma'],
            'data_inicio_turma' => $record['data_inicio_turma'],
            'data_fim_turma' => $record['data_fim_turma'],
            'situacao_turma' => Deparas::statusTurma[$record['situacao_turma']] ?? $record['situacao_turma'],
            'carga_horaria_teorica' => $record['carga_horaria_teorica'],
            'carga_horaria_pratica' => $record['carga_horaria_pratica'],
            'numero_alunos_inicial' => $record['numero_alunos_inicial'],
            'trancamentos_pct' => round($record['trancamentos_pct'], 1),
            'numero_alunos_final' => $record['numero_alunos_final'],
            'pendencia_pct' => round($record['pendencia_pct'], 1),
            'recuperacao_pct' => round($record['recuperacao_pct'], 1),
            'aprovacao_pct' => round($record['aprovacao_pct'], 1),
            'reprov_nota_pct' => round($record['reprov_nota_pct'], 1),
            'reprov_freq_pct' => round($record['reprov_freq_pct'], 1),
            'reprov_ambos_pct' => round($record['reprov_ambos_pct'], 1),
            'frequencia_media' => round($record['frequencia_media'], 1),
            'nota_media' => round($record['nota_media'], 1),
        ];

        return $properties;
    }
}
