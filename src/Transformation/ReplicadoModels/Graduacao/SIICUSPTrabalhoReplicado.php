<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class SIICUSPTrabalhoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_trabalho' => ReplicadoModelsUtils::getSiicuspTrabalhoId($record),
            'titulo_trabalho' => CommonUtils::cleanInput(
                $record['titulo_trabalho'],
                [
                    'decode_html',
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
            'id_projeto_ic' => isset($record['codigo_projeto'])
                ? ReplicadoModelsUtils::getICId($record)
                : null,
            'edicao_siicusp' => $record['edicao_siicusp'],
            'situacao_inscricao' => $record['situacao_inscricao'],
            'situacao_apresentacao' => $this->checkSituacaoApresentacao(
                $record['apresentado_siicusp'],
                $record['tipo_participante_apresentou']
            ),
            'prox_etapa_recomendado' => $record['prox_etapa_recomendado'],
            'prox_etapa_apresentado' => $record['prox_etapa_apresentado'],
            'mencao_honrosa' => $record['mencao_honrosa'],
            'codigo_dpto_orientador' => $record['codigo_dpto_orientador'],
            'nome_dpto_orientador' => $record['nome_dpto_orientador'],
        ];

        return $properties;
    }


    private function checkSituacaoApresentacao(?string $apresentado, ?string $tipoParticipante)
    {
        if ($tipoParticipante == 'F') {
            return 'Apresentador faltante';
        } elseif ($tipoParticipante == 'J') {
            return 'Ausência justificada';
        } else {
            return Deparas::apresentacaoSIICUSP[$apresentado] ?? $apresentado;
        }
    }
}
