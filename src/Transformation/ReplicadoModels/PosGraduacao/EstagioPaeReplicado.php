<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class EstagioPaeReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_pae' => ReplicadoModelsUtils::getEstagioPaeId($record),
            'numero_usp' => $record['numero_usp'],
            'nivel_programa' => Deparas::niveisPG[$record['nivel_programa']]
                ?? $record['nivel_programa'],
            'modalidade_pae' => $record['modalidade_pae'],
            'data_inicio_pae' => $record['data_inicio_pae'],
            'data_fim_pae' => $record['data_fim_pae'],
            'observacao' => $record['observacao'],
            'justificativa_cancelamento' => $record['justificativa_cancelamento'],
            'inscrito' => $record['inscrito'],
            'codigo_disciplina_estagio' => $record['codigo_disciplina_estagio'],
            'versao_disciplina_estagio' => $record['versao_disciplina_estagio'],
            'situacao_estagio' => Deparas::situacoesEstagioPAE[$record['situacao_estagio']]
                ?? $record['situacao_estagio'],
            'unidade_estagio' => $record['unidade_estagio'],
            'numero_usp_supervisor' => $record['numero_usp_supervisor'],
            'periodo_epp' => $record['periodo_epp'],
            'situacao_epp' => Deparas::situacoesEPP[$record['situacao_epp']] ?? $record['situacao_epp'],
            'modalidade_epp' => Deparas::modalidadesEPP[$record['modalidade_epp']] ?? $record['modalidade_epp'],
            'codigo_disciplina_epp' => $record['codigo_disciplina_epp'],
            'unidade_epp' => $record['unidade_epp'],
            'situacao_inscricao' => Deparas::situacoesInscricaoPAE[$record['situacao_inscricao']]
                ?? $record['situacao_inscricao'],
            'classificacao_bolsa' => $record['classificacao_bolsa'],
            'bolsista_ou_voluntario' => $record['bolsista_ou_voluntario'],
            'unidade_inscricao' => $record['unidade_inscricao'],
            'observacao2' => $record['observacao2'],
            'organizacao_disciplina_externa' => $record['organizacao_disciplina_externa'],
            'unidade_cota_interunidades' => $record['unidade_cota_interunidades'],
            'validacao_inscricao_orientador' => Deparas::validacaoPAE[$record['validacao_inscricao_orientador']]
                ?? $record['validacao_inscricao_orientador'],
            'validacao_inscricao_supervisor' => Deparas::validacaoPAE[$record['validacao_inscricao_supervisor']]
                ?? $record['validacao_inscricao_supervisor'],
            'validacao_inscricao_unidade' => $record['validacao_inscricao_unidade'],
            'validacao_inscricao_pro_reitoria' => $record['validacao_inscricao_pro_reitoria'],
            'vinculo_empregaticio' => Deparas::vinculoEmpregaticioPAE[$record['vinculo_empregaticio']]
                ?? $record['vinculo_empregaticio'],
        ];

        return $properties;
    }
}
