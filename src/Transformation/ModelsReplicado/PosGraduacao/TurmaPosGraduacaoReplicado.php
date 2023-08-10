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
                    $turmaPG['sequencia_turma']
                )),
           'codigo_disciplina' => $turmaPG['codigo_disciplina'],
           'versao_disciplina' => $turmaPG['versao_disciplina'],
           'vagas_regulares' => $turmaPG['vagas_regulares'],
           'vagas_especiais' => $turmaPG['vagas_especiais'],
           'vagas_total' => $turmaPG['vagas_total'],
           'data_inicio_turma' => $turmaPG['data_inicio_turma'],
           'data_fim_turma' => $turmaPG['data_fim_turma'],
           'consolidacao_turma' => $turmaPG['consolidacao_turma'],
           'consolidacao_resultados' => $turmaPG['consolidacao_resultados'],
           'codigo_area' => $turmaPG['codigo_area'],
           'codigo_convenio' => $turmaPG['codigo_convenio'],
           'nivel_convenio' => $turmaPG['nivel_convenio'],
           'data_cancelamento' => $turmaPG['data_cancelamento'],
           'motivo_cancelamento' => $turmaPG['motivo_cancelamento'],
           'lingua_turma' => $turmaPG['lingua_turma'],
           'formato_oferecimento' => $turmaPG['formato_oferecimento'],
        ];

        return $properties;
    }
}