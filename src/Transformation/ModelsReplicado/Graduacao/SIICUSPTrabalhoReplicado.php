<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class SIICUSPTrabalhoReplicado implements Mapper
{
    public function mapping(Array $trabalho)
    {
        $trabalho = Utils::emptiesToNull($trabalho);

        $properties = [
            'idTrabalho' => $trabalho['edicaoSIICUSP'] . "-" . $trabalho['codigoTrabalho'],
            'tituloTrabalho' => $trabalho['tituloTrabalho'],
            'idProjetoIC' => isset($trabalho['codigoProjeto'])
                           ? $trabalho['anoProjeto'] . "-" . $trabalho['codigoProjeto']
                           : null,
            'edicaoSIICUSP' => $trabalho['edicaoSIICUSP'],
            'situacaoSIICUSP' => $this->checkSituacaoSIICUSP(
                                                        $trabalho['apresentadoSIICUSP'], 
                                                        $trabalho['tipoParticipanteApresentou']
                                    ),
            'proxEtapaRecomendado' => Deparas::boolSIICUSP[$trabalho['proxEtapaRecomendado']] ?? false,
            'proxEtapaApresentado' => Deparas::boolSIICUSP[$trabalho['proxEtapaApresentado']] ?? false,
            'mencaoHonrosa' => Deparas::boolSIICUSP[$trabalho['mencaoHonrosa']] ?? false,
            'codigoDptoOrientador' => $trabalho['codigoDptoOrientador'],
            'nomeDptoOrientador' => $trabalho['nomeDptoOrientador'],
        ];

        return $properties;
    }

    
    private function checkSituacaoSIICUSP(?string $apresentado, ?string $tipoParticipante)
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