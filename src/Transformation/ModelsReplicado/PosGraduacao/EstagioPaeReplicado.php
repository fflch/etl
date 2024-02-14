<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class EstagioPaeReplicado implements Mapper
{
    public function mapping(array $pae)
    {
        $properties = [
            'id_pae' => strtoupper(substr(
                hash(
                    'sha256',
                    $pae['numero_usp'] . '-' .
                    $pae['data_inicio_pae'] . '-' .
                    $pae['modalidade_pae'] . '-' .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32
            )),
            'numero_usp' => $pae['numero_usp'],
            'nivel_programa' => Deparas::niveisPG[$pae['nivel_programa']]
                ?? $pae['nivel_programa'],
            'modalidade_pae' => $pae['modalidade_pae'],
            'data_inicio_pae' => $pae['data_inicio_pae'],
            'data_fim_pae' => $pae['data_fim_pae'],
            'observacao' => $pae['observacao'],
            'justificativa_cancelamento' => $pae['justificativa_cancelamento'],
            'inscrito' => $pae['inscrito'],
            'codigo_disciplina_estagio' => $pae['codigo_disciplina_estagio'],
            'versao_disciplina_estagio' => $pae['versao_disciplina_estagio'],
            'situacao_estagio' => Deparas::situacoesEstagioPAE[$pae['situacao_estagio']]
                ?? $pae['situacao_estagio'],
            'unidade_estagio' => $pae['unidade_estagio'],
            'numero_usp_supervisor' => $pae['numero_usp_supervisor'],
            'periodo_epp' => $pae['periodo_epp'],
            'situacao_epp' => Deparas::situacoesEPP[$pae['situacao_epp']] ?? $pae['situacao_epp'],
            'modalidade_epp' => Deparas::modalidadesEPP[$pae['modalidade_epp']] ?? $pae['modalidade_epp'],
            'codigo_disciplina_epp' => $pae['codigo_disciplina_epp'],
            'unidade_epp' => $pae['unidade_epp'],
            'situacao_inscricao' => Deparas::situacoesInscricaoPAE[$pae['situacao_inscricao']]
                ?? $pae['situacao_inscricao'],
            'classificacao_bolsa' => $pae['classificacao_bolsa'],
            'bolsista_ou_voluntario' => $pae['bolsista_ou_voluntario'],
            'unidade_inscricao' => $pae['unidade_inscricao'],
            'observacao2' => $pae['observacao2'],
            'organizacao_disciplina_externa' => $pae['organizacao_disciplina_externa'],
            'unidade_cota_interunidades' => $pae['unidade_cota_interunidades'],
            'validacao_inscricao_orientador' => Deparas::validacaoPAE[$pae['validacao_inscricao_orientador']]
                ?? $pae['validacao_inscricao_orientador'],
            'validacao_inscricao_supervisor' => Deparas::validacaoPAE[$pae['validacao_inscricao_supervisor']]
                ?? $pae['validacao_inscricao_supervisor'],
            'validacao_inscricao_unidade' => $pae['validacao_inscricao_unidade'],
            'validacao_inscricao_pro_reitoria' => $pae['validacao_inscricao_pro_reitoria'],
            'vinculo_empregaticio' => Deparas::vinculoEmpregaticioPAE[$pae['vinculo_empregaticio']]
                ?? $pae['vinculo_empregaticio'],
        ];

        return $properties;
    }
}
