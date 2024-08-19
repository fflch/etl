<?php

namespace Src\Utils;

class ReplicadoModelsUtils
{
    public static function getTurmaPosGraduacaoId($data)
    {
        $singleTurmaString = $data['codigo_disciplina'] .
            $data['versao_disciplina'] .
            $data['codigo_turma'];

        return CommonUtils::plainMd5Hash($singleTurmaString);
    }

    public static function getEstagioPaeId($data)
    {
        $singlePaeString = $data['numero_usp'] . '-' .
            $data['data_inicio_pae'] . '-' .
            $data['modalidade_pae'] . '-';

        return CommonUtils::pepperedSha256Hash($singlePaeString, 32);
    }

    public static function getDisciplinaPosGraduacaoId($data)
    {
        $singleDisciplinaString = $data['codigo_disciplina'] .
            $data['versao_disciplina'];

        return CommonUtils::plainMd5Hash($singleDisciplinaString, 8);
    }

    public static function getCredenciamentoId($data)
    {
        $singleCredenciamentoString = $data['numero_usp'] .
            $data['codigo_area'] .
            $data['data_inicio_validade'];

        return CommonUtils::pepperedSha256Hash($singleCredenciamentoString, 32);
    }

    public static function getPosGraduacaoId($data)
    {
        $singlePosGraduacaoString = $data['numero_usp'] .
            $data['seq_programa'] .
            $data['codigo_area'];

        return CommonUtils::pepperedSha256Hash($singlePosGraduacaoString, 32);
    }

    public static function getBolsaPosGraduacaoId($data)
    {
        $singleBolsaString = $data['codigo_instituicao_fomento'] . "." .
            $data['codigo_programa_fomento'] . "." .
            $data['codigo_bolsa_fomento'];

        return CommonUtils::plainMd5Hash($singleBolsaString, 12);
    }

    public static function getParticipacaoBancaId($data)
    {
        $singleParticipacaoString =
            $data['numero_usp_membro'] .
            $data['numero_usp'] .
            $data['seq_programa'] .
            $data['codigo_area'] .
            $data['sequencia_participacao'];

        return CommonUtils::pepperedSha256Hash($singleParticipacaoString, 32);
    }

    public static function getDefesaId($data)
    {
        $singleDefesaString =
            'DEFESA' .
            $data['numero_usp'] .
            $data['seq_programa'] .
            $data['codigo_area'];

        return CommonUtils::pepperedSha256Hash($singleDefesaString, 32);
    }

    public static function getSiicuspTrabalhoId($data)
    {
        return $data['edicao_siicusp'] . "-" . $data['codigo_trabalho'];
    }

    public static function getDisciplinaGraduacaoId($data)
    {
        $singleDisciplinaString =
            $data['codigo_disciplina'] .
            $data['versao_disciplina'];

        return CommonUtils::plainMd5Hash($singleDisciplinaString, 8);
    }

    public static function getTurmaGraduacaoId($data)
    {
        $singleTurmaString =
            $data['codigo_disciplina'] .
            $data['versao_disciplina'] .
            $data['codigo_turma'];

        return CommonUtils::plainMd5Hash($singleTurmaString);
    }

    public static function getICId($data)
    {
        return $data['ano_projeto'] . '-' . $data['codigo_projeto'];
    }

    public static function getOferecimentoCCExId($data)
    {
        $singleOferecimentoString =
            $data['codigo_curso_ceu'] .
            $data['codigo_edicao_curso'] .
            $data['sequencia_oferecimento'];

        return CommonUtils::plainMd5Hash($singleOferecimentoString);
    }

    public static function getPesquisaAvancadaId($data)
    {
        return $data['ano_projeto'] . '-' . $data['codigo_projeto'];
    }

    public static function getAuxilioId($data)
    {
        $singleAuxilioIdString =
            $data['codigo_auxilio'] .
            $data['sequencia_auxilio'] .
            $data['periodo_referencial'] .
            $data['numero_usp'] .
            $data['data_inicio_auxilio'];

        return CommonUtils::pepperedSha256Hash($singleAuxilioIdString, 32);
    }

    public static function getBolsaDiversaId($data)
    {
        $singleBolsaDiversaIdString =
            $data['codigo_programa_usp'] .
            $data['sequencia_programa_usp'] .
            $data['periodo_referencial'] .
            $data['numero_usp'] .
            $data['data_inicio_bolsa'];

        return CommonUtils::pepperedSha256Hash($singleBolsaDiversaIdString, 32);
    }

    public static function getInscricaoProjetoDivId($data)
    {
        $singleInscricaoProjetoDivIdString =
            $data['codigo_programa_usp'] .
            $data['sequencia_programa_usp'] .
            $data['periodo_referencial'] .
            $data['codigo_projeto_diverso'] .
            $data['numero_usp'];

        return CommonUtils::pepperedSha256Hash($singleInscricaoProjetoDivIdString, 32);
    }

    public static function getProjetoDiversoId($data)
    {
        $singleProjetoDiversoIdString =
            $data['codigo_programa_usp'] .
            $data['sequencia_programa_usp'] .
            $data['periodo_referencial'] .
            $data['codigo_projeto_diverso'];

        return CommonUtils::plainMd5Hash($singleProjetoDiversoIdString, 12);
    }

    public static function getGraduacaoId($data)
    {
        $singleGraduacaoIdString =
            $data['numero_usp'] .
            $data['sequencia_grad'];

        return CommonUtils::pepperedSha256Hash(
            $singleGraduacaoIdString,
            32
        );
    }

    public static function getQuestaoId($data)
    {
        return $data['codigo_questionario'] . "-" .
            str_pad($data['codigo_questao'], 2, 0, STR_PAD_LEFT);
    }

    public static function getVinculoId($data)
    {
        $singleVinculoIdString =
            $data['numero_usp'] .
            $data['sequencia_vinculo'] .
            $data['vinculo'];

        return CommonUtils::pepperedSha256Hash($singleVinculoIdString, 32);
    }
}
