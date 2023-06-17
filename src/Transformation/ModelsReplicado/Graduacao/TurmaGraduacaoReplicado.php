<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\TransformationUtils;
use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class TurmaGraduacaoReplicado implements Mapper
{
    public function mapping(Array $turma)
    {
        $properties = [
            'codigo_disciplina' => $turma['codigo_disciplina'],
            'versao_disciplina' => $turma['versao_disciplina'],
            'codigo_turma' => $turma['codigo_turma'],
            'tipo_turma' => $turma['tipo_turma'],
            'data_criacao_turma' => $turma['data_criacao_turma'],
            'data_inicio_aulas' => $turma['data_inicio_aulas'],
            'data_fim_aulas' => $turma['data_fim_aulas'],
            'status_turma' => Deparas::statusTurma[$turma['status_turma']] ?? $turma['status_turma'],
            'carga_horaria_teorica' => $turma['carga_horaria_teorica'],
            'carga_horaria_pratica' => $turma['carga_horaria_pratica'],
            'numero_alunos_cursou' => $turma['numero_alunos_cursou'],
            'aprovados_pct' => $turma['aprovados_pct'],
            'trancamentos_pct' => $turma['trancamentos_pct'],
            'reprov_nota_pct' => $turma['reprov_nota_pct'],
            'reprov_freq_pct' => $turma['reprov_freq_pct'],
            'reprov_ambos_pct' => $turma['reprov_ambos_pct'],
            'numero_alunos_finalizou' => $turma['numero_alunos_finalizou'],
            'frequencia_media' => $turma['frequencia_media'],
            'nota_media' => $turma['nota_media'],
        ];

        return $properties;
    }
}