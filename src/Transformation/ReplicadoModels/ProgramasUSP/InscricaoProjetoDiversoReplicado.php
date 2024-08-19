<?php

namespace Src\Transformation\ReplicadoModels\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class InscricaoProjetoDiversoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_inscricao_projeto' => ReplicadoModelsUtils::getInscricaoProjetoDivId($record),
            'id_projeto_diverso' => ReplicadoModelsUtils::getProjetoDiversoId($record),
            'numero_usp' => $record['numero_usp'],
            'tipo_vinculo_inscrito' => $record['tipo_vinculo_inscrito'],
            'data_inscricao_projeto' => $record['data_inscricao_projeto'],
            'inscricao_selecionada' => $record['inscricao_selecionada'],
            'data_selecao_rejeicao' => $record['data_selecao_rejeicao'],
            'selecionado_docente_outro_projeto' => $record['selecionado_docente_outro_projeto'],
            'comparecimento_entrevista' => $record['comparecimento_entrevista'],
            'cursou_disciplina' => $record['cursou_disciplina'],
            'status_aceite_aluno' => $record['status_aceite_aluno'],
            'data_aceite_aluno' => $record['data_aceite_aluno'],
            'status_aceite_docente' => $record['status_aceite_docente'],
            'data_aceite_docente' => $record['data_aceite_docente'],
            'data_solicitacao_desligamento' => $record['data_solicitacao_desligamento'],
            'codigo_motivo_solicitacao_desligamento' => $record['codigo_motivo_solicitacao_desligamento'],
            'motivo_desligamento' => $record['motivo_desligamento'],
            'motivo_desligamento_solicitacao_outro' => $record['motivo_desligamento_solicitacao_outro'],
            'status_resultado_solicitacao_desligamento' => $record['status_resultado_solicitacao_desligamento'],
            'data_resultado_solicitacao_desligamento' => $record['data_resultado_solicitacao_desligamento'],
            'data_envio_relatorio_final' => $record['data_envio_relatorio_final'],
            'solicitou_substituicao' => $record['solicitou_substituicao'],
            'numero_usp_substituto' => $record['numero_usp_substituto'],
            'bolsista_ou_voluntario' => $record['bolsista_ou_voluntario'],
        ];

        return $properties;
    }
}
