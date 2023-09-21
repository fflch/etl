<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class BancaPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $banca)
    {
        $properties = [
            'id_participacao_banca' => strtoupper(substr(
                hash('sha256',
                    $banca['numero_usp_membro'] . 
                    $banca['numero_usp_aluno'] . 
                    $banca['seq_programa'] .
                    $banca['codigo_area'] .
                    $banca['sequencia_participacao'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'id_defesa' => strtoupper(substr(
                hash('sha256',
                    'DEFESA' .
                    $banca['numero_usp_aluno'] . 
                    $banca['seq_programa'] .
                    $banca['codigo_area'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'numero_usp_membro' => $banca['numero_usp_membro'],
            'vinculo_participacao' => Deparas::funcoesBanca[$banca['vinculo_participacao']] 
                                      ?? $banca['vinculo_participacao'],
            'participacao_assinalada' => $banca['participacao_assinalada'],
            'tipoAvaliacao' => $this->checkTipoAvaliacao($banca['nota_defesa'], $banca['avaliacao_defesa']),
            'nota_defesa' => $banca['nota_defesa'],
            'avaliacao_defesa' => $banca['avaliacao_defesa'],
            'especialista' => $banca['especialista'], 
            // i.e. "não tem título acadêmico mas é reconhecido pelo conhecimento técnico"
            'avaliacao_escrita' => $banca['avaliacao_escrita'],
            'voto_dupla_titulacao' => $banca['voto_dupla_titulacao'],
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