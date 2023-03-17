<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class OferecimentoCCExReplicado implements Mapper
{
    public function mapping(Array $oferecimentoCCEx)
    {
        $oferecimentoCCEx = Utils::emptiesToNull($oferecimentoCCEx);

        $properties = [
            'codigo_oferecimento' => strtoupper(md5(
                                        $oferecimentoCCEx['codigo_curso_ceu'] . 
                                        $oferecimentoCCEx['codigo_edicao_curso'] . 
                                        $oferecimentoCCEx['sequencia_oferecimento']
                                    )),
            'codigo_curso_ceu' => $oferecimentoCCEx['codigo_curso_ceu'],
            'situacao_oferecimento' => $oferecimentoCCEx['situacao_oferecimento'],
            'data_inicio_oferecimento' => $oferecimentoCCEx['data_inicio_oferecimento'],
            'data_fim_oferecimento' => $oferecimentoCCEx['data_fim_oferecimento'],
            'total_carga_horaria' => ($oferecimentoCCEx['total_carga_horaria'] / 60),
            'qntd_vagas_ofertadas' => $oferecimentoCCEx['qntd_vagas_ofertadas'],
            'curso_pago' => $oferecimentoCCEx['curso_pago'],
            'valor_inscricao_edicao' => $oferecimentoCCEx['valor_inscricao_edicao'],
            'qntd_vagas_gratuitas' => $oferecimentoCCEx['qntd_vagas_gratuitas'],
            'valor_previsto_arrecadacao' => $oferecimentoCCEx['valor_previsto_arrecadacao'],
            'valor_previsto_custos' => $oferecimentoCCEx['valor_previsto_custos'],
            'valor_previsto_prce' => $oferecimentoCCEx['valor_previsto_prce'],
            'curso_para_empresas' => $oferecimentoCCEx['curso_para_empresas'],
            'local_curso' => $oferecimentoCCEx['local_curso'],
            'data_inicio_inscricoes' => $oferecimentoCCEx['data_inicio_inscricoes'],
            'data_fim_inscricoes' => $oferecimentoCCEx['data_fim_inscricoes'],
            'permite_inscricao_online' => $oferecimentoCCEx['permite_inscricao_online'],
        ];

        return $properties;
    }
}