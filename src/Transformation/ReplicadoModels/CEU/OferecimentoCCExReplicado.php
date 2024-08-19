<?php

namespace Src\Transformation\ReplicadoModels\CEU;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class OferecimentoCCExReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'codigo_oferecimento' => ReplicadoModelsUtils::getOferecimentoCCExId($record),
            'codigo_curso_ceu' => $record['codigo_curso_ceu'],
            'situacao_oferecimento' => Deparas::situacaoEdicaoCCEx[$record['situacao_oferecimento']]
                ?? $record['situacao_oferecimento'],
            'data_inicio_oferecimento' => $record['data_inicio_oferecimento'],
            'data_fim_oferecimento' => $record['data_fim_oferecimento'],
            'total_carga_horaria' => ($record['total_carga_horaria'] / 60),
            'qntd_vagas_ofertadas' => $record['qntd_vagas_ofertadas'],
            'curso_pago' => $record['curso_pago'],
            'valor_inscricao_edicao' => $record['valor_inscricao_edicao'],
            'qntd_vagas_gratuitas' => $record['qntd_vagas_gratuitas'],
            'valor_previsto_arrecadacao' => $record['valor_previsto_arrecadacao'],
            'valor_previsto_custos' => $record['valor_previsto_custos'],
            'valor_previsto_prce' => $record['valor_previsto_prce'],
            'curso_para_empresas' => $record['curso_para_empresas'],
            'local_curso' => CommonUtils::cleanInput(
                $record['local_curso'],
                ['remove_trailing_periods']
            ),
            'data_inicio_inscricoes' => $record['data_inicio_inscricoes'],
            'data_fim_inscricoes' => $record['data_fim_inscricoes'],
            'permite_inscricao_online' => $record['permite_inscricao_online'],
        ];

        return $properties;
    }
}
