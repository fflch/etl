<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class SIICUSPInscricaoReplicado implements Mapper
{
    public function mapping(Array $inscricao)
    {
        $inscricao = Utils::emptiesToNull($inscricao);

        $properties = [
            'idTrabalho' => $inscricao['edicaoSIICUSP'] . "-" . $inscricao['codigoTrabalho'],
            'tituloTrabalho' => $inscricao['tituloTrabalho'],
            'idProjeto' => isset($inscricao['codigoProjeto'])
                           ? $inscricao['anoProjeto'] . "-" . $inscricao['codigoProjeto']
                           : null,
            'edicaoSIICUSP' => $inscricao['edicaoSIICUSP'],
            'apresentadoSIICUSP' => $inscricao['apresentadoSIICUSP'],
            'tipoParticipanteApresentou' => $inscricao['tipoParticipanteApresentou'],
            'proxEtapaRecomendado' => Deparas::SIICUSPBool[$inscricao['proxEtapaRecomendado']] ?? false,
            'proxEtapaApresentado' => Deparas::SIICUSPBool[$inscricao['proxEtapaApresentado']] ?? false,
            'mencaoHonrosa' => Deparas::SIICUSPBool[$inscricao['mencaoHonrosa']] ?? false,
            'codigoDptoApresentacao' => $inscricao['codigoDptoApresentacao'],
            'nomeDptoApresentacao' => $inscricao['nomeDptoApresentacao'],
        ];

        return $properties;
    }
}