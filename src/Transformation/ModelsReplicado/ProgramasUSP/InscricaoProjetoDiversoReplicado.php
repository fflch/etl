<?php

namespace Src\Transformation\ModelsReplicado\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;

class InscricaoProjetoDiversoReplicado implements Mapper
{
    public function mapping(Array $inscricao)
    {
        $properties = [
            'id_inscricao_projeto' => strtoupper(substr(
                hash('sha256',
                    $inscricao['codigo_programa_usp'] . 
                    $inscricao['sequencia_programa_usp'] . 
                    $inscricao['periodo_referencial'] . 
                    $inscricao['codigo_projeto_diverso'] . 
                    $inscricao['numero_usp'] . 
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'id_projeto_diverso' => strtoupper(substr(md5(
                $inscricao['codigo_programa_usp'] . 
                $inscricao['sequencia_programa_usp'] . 
                $inscricao['periodo_referencial'] . 
                $inscricao['codigo_projeto_diverso']
                ), 0, 12)
            ),
            'numero_usp' => $inscricao['numero_usp'],
            'tipo_vinculo_inscrito' => $inscricao['tipo_vinculo_inscrito'],
            'data_inscricao_projeto' => $inscricao['data_inscricao_projeto'],
            'inscricao_selecionada' => $inscricao['inscricao_selecionada'],
            'data_selecao_rejeicao' => $inscricao['data_selecao_rejeicao'],
            'selecionado_docente_outro_projeto' => $inscricao['selecionado_docente_outro_projeto'],
            'comparecimento_entrevista' => $inscricao['comparecimento_entrevista'],
            'cursou_disciplina' => $inscricao['cursou_disciplina'],
            'status_aceite_aluno' => $inscricao['status_aceite_aluno'],
            'data_aceite_aluno' => $inscricao['data_aceite_aluno'],
            'status_aceite_docente' => $inscricao['status_aceite_docente'],
            'data_aceite_docente' => $inscricao['data_aceite_docente'],
            'data_solicitacao_desligamento' => $inscricao['data_solicitacao_desligamento'],
            'codigo_motivo_solicitacao_desligamento' => $inscricao['codigo_motivo_solicitacao_desligamento'],
            'motivo_desligamento' => $inscricao['motivo_desligamento'],
            'motivo_desligamento_solicitacao_outro' => $inscricao['motivo_desligamento_solicitacao_outro'],
            'status_resultado_solicitacao_desligamento' => $inscricao['status_resultado_solicitacao_desligamento'],
            'data_resultado_solicitacao_desligamento' => $inscricao['data_resultado_solicitacao_desligamento'],
            'data_envio_relatorio_final' => $inscricao['data_envio_relatorio_final'],
            'solicitou_substituicao' => $inscricao['solicitou_substituicao'],
            'numero_usp_substituto' => $inscricao['numero_usp_substituto'],
            'bolsista_ou_voluntario' => $inscricao['bolsista_ou_voluntario'],
        ];

        return $properties;
    }
}