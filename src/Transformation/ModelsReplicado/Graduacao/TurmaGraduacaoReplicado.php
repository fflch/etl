<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class TurmaGraduacaoReplicado implements Mapper
{
    public function mapping(Array $turma)
    {
        $properties = [
            'id_turma' => strtoupper(
                md5(
                    $turma['codigo_disciplina'] . 
                    $turma['versao_disciplina'] . 
                    $turma['codigo_turma']
                )),
            'codigo_disciplina' => $turma['codigo_disciplina'],
            'versao_disciplina' => $turma['versao_disciplina'],
            'codigo_turma' => $turma['codigo_turma'],
            'tipo_turma' => $turma['tipo_turma'],
            'data_criacao_turma' => $turma['data_criacao_turma'],
            'data_inicio_turma' => $turma['data_inicio_turma'],
            'data_fim_turma' => $turma['data_fim_turma'],
            'situacao_turma' => Deparas::statusTurma[$turma['situacao_turma']] ?? $turma['situacao_turma'],
            'carga_horaria_teorica' => $turma['carga_horaria_teorica'],
            'carga_horaria_pratica' => $turma['carga_horaria_pratica'],
            'numero_alunos_inicial' => $turma['numero_alunos_inicial'],
            'trancamentos_pct' => round($turma['trancamentos_pct'], 1),
            'numero_alunos_final' => $turma['numero_alunos_final'],
            'pendencia_pct' => round($turma['pendencia_pct'], 1),
            'recuperacao_pct' => round($turma['recuperacao_pct'], 1),
            'aprovacao_pct' => round($turma['aprovacao_pct'], 1),
            'reprov_nota_pct' => round($turma['reprov_nota_pct'], 1),
            'reprov_freq_pct' => round($turma['reprov_freq_pct'], 1),
            'reprov_ambos_pct' => round($turma['reprov_ambos_pct'], 1),
            'frequencia_media' => round($turma['frequencia_media'], 1),
            'nota_media' => round($turma['nota_media'], 1),
        ];

        return $properties;
    }
}