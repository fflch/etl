<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class TurmaPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $turmaPG)
    {
        $properties = [
            'id_turma' => strtoupper(
                md5(
                    $turmaPG['codigo_disciplina'] . 
                    $turmaPG['versao_disciplina'] . 
                    $turmaPG['codigo_turma']
                )),
            'codigo_disciplina' => $turmaPG['codigo_disciplina'],
            'versao_disciplina' => $turmaPG['versao_disciplina'],
            'codigo_turma' => $turmaPG['codigo_turma'],
            'status_turma' => $turmaPG['status_turma'],
            'data_inicio_turma' => $turmaPG['data_inicio_turma'],
            'data_fim_turma' => $turmaPG['data_fim_turma'],
            'vagas_regulares' => $turmaPG['vagas_regulares'],
            'vagas_especiais' => $turmaPG['vagas_especiais'],
            'vagas_total' => $turmaPG['vagas_total'],
            'num_inscritos' => $turmaPG['num_inscritos'],
            'num_matriculas_deferidas' => $turmaPG['num_matriculas_deferidas'],
            'num_matriculas_indeferidas' => $turmaPG['num_matriculas_indeferidas'],
            'num_matriculas_canceladas' => $turmaPG['num_matriculas_canceladas'],
            'consolidacao_turma' => $turmaPG['consolidacao_turma'],
            'consolidacao_resultados' => $turmaPG['consolidacao_resultados'],
            'data_cancelamento' => $turmaPG['data_cancelamento'],
            'motivo_cancelamento' => $turmaPG['motivo_cancelamento'],
            'frequencia_media' => $turmaPG['frequencia_media'],
            'aprovacao_pct' => $turmaPG['aprovacao_pct'],
            'reprovacao_pct' => $turmaPG['reprovacao_pct'],
            'pendencia_pct' => $turmaPG['pendencia_pct'],
            'alunos_fflch_pct' => $turmaPG['alunos_fflch_pct'],
            'alunos_externos_pct' => $turmaPG['alunos_externos_pct'],
            'codigo_area' => $turmaPG['codigo_area'],
            'codigo_convenio' => $turmaPG['codigo_convenio'],
            'nivel_convenio' => $turmaPG['nivel_convenio'],
            'lingua_turma' => $turmaPG['lingua_turma'],
            'formato_oferecimento' => $turmaPG['formato_oferecimento'],
        ];

        return $properties;
    }
}