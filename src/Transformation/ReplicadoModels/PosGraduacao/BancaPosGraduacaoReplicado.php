<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class BancaPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_participacao_banca' => ReplicadoModelsUtils::getParticipacaoBancaId($record),
            'id_defesa' => ReplicadoModelsUtils::getDefesaId($record),
            'numero_usp_membro' => $record['numero_usp_membro'],
            'vinculo_participacao' => Deparas::funcoesBanca[$record['vinculo_participacao']]
                ?? $record['vinculo_participacao'],
            'participacao_assinalada' => $record['participacao_assinalada'],
            'tipo_avaliacao' => $this->checkTipoAvaliacao($record['nota_defesa'], $record['avaliacao_defesa']),
            'nota_defesa' => $record['nota_defesa'],
            'avaliacao_defesa' => $record['avaliacao_defesa'],
            'especialista' => $record['especialista'],
            // i.e. "não tem título acadêmico mas é reconhecido pelo conhecimento técnico"
            'avaliacao_escrita' => $record['avaliacao_escrita'],
            'voto_dupla_titulacao' => $record['voto_dupla_titulacao'],
        ];

        return $properties;
    }

    private function checkTipoAvaliacao(?float $nota, ?string $avaliacao)
    {
        return is_null($avaliacao) && !is_null($nota)
            ? 'Quantitativa'
            : 'Qualitativa';
    }
}
