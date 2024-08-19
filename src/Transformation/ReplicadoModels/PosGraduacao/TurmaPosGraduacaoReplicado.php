<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class TurmaPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_turma' => ReplicadoModelsUtils::getTurmaGraduacaoId($record),
            'id_disciplina' => ReplicadoModelsUtils::getDisciplinaPosGraduacaoId($record),
            'codigo_turma' => $record['codigo_turma'],
            'situacao_turma' => $record['situacao_turma'],
            'data_inicio_turma' => $record['data_inicio_turma'],
            'data_fim_turma' => $record['data_fim_turma'],
            'vagas_regulares' => $record['vagas_regulares'],
            'vagas_especiais' => $record['vagas_especiais'],
            'vagas_total' => $record['vagas_total'],
            'num_inscritos' => $record['num_inscritos'],
            'num_matriculas_deferidas' => $record['num_matriculas_deferidas'],
            'num_matriculas_indeferidas' => $record['num_matriculas_indeferidas'],
            'num_matriculas_canceladas' => $record['num_matriculas_canceladas'],
            'consolidacao_turma' => $record['consolidacao_turma'],
            'consolidacao_resultados' => $record['consolidacao_resultados'],
            'data_cancelamento' => $record['data_cancelamento'],
            'motivo_cancelamento' => $record['motivo_cancelamento'],
            'frequencia_media' => $record['frequencia_media'],
            'aprovacao_pct' => $record['aprovacao_pct'],
            'reprovacao_pct' => $record['reprovacao_pct'],
            'pendencia_pct' => $record['pendencia_pct'],
            'alunos_fflch_pct' => $record['alunos_fflch_pct'],
            'alunos_externos_pct' => $record['alunos_externos_pct'],
            'codigo_area' => $record['codigo_area'],
            'codigo_convenio' => $record['codigo_convenio'],
            'nivel_convenio' => Deparas::niveisPG[$record['nivel_convenio']]
                ?? $record['nivel_convenio'],
            'lingua_turma' => $record['lingua_turma'],
            'formato_oferecimento' => $record['formato_oferecimento'],
        ];

        return $properties;
    }
}
