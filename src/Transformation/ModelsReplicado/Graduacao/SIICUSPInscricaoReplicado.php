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
            'idProjetoIC' => isset($inscricao['codigoProjeto'])
                           ? $inscricao['anoProjeto'] . "-" . $inscricao['codigoProjeto']
                           : null,
            'edicaoSIICUSP' => $inscricao['edicaoSIICUSP'],
            'situacaoSIICUSP' => $this->apresentacaoSIICUSP(
                                                        $inscricao['apresentadoSIICUSP'], 
                                                        $inscricao['tipoParticipanteApresentou']
                                    ),
            'proxEtapaRecomendado' => Deparas::boolSIICUSP[$inscricao['proxEtapaRecomendado']] ?? false,
            'proxEtapaApresentado' => Deparas::boolSIICUSP[$inscricao['proxEtapaApresentado']] ?? false,
            'mencaoHonrosa' => Deparas::boolSIICUSP[$inscricao['mencaoHonrosa']] ?? false,
            'codigoDptoOrientador' => $inscricao['codigoDptoOrientador'],
            'nomeDptoOrientador' => $inscricao['nomeDptoOrientador'],
        ];

        return $properties;
    }

    
    private function apresentacaoSIICUSP(?string $apresentado, ?string $tipoParticipante)
    {
        if($tipoParticipante == 'F'){
            return 'Apresentador faltante';
        }
        elseif($tipoParticipante == 'J'){
            return 'Ausência justificada';
        }
        else{
            return Deparas::apresentacaoSIICUSP[$apresentado] ?? $apresentado;
        }
    }
}