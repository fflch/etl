<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class OferecimentoCCExReplicado implements Mapper
{
    public function mapping(Array $oferecimentoCCEx)
    {
        $oferecimentoCCEx = Utils::emptiesToNull($oferecimentoCCEx);

        $properties = [
            'codigoOferecimento' => strtoupper(md5(
                                        $oferecimentoCCEx['codigoCursoCEU'] . 
                                        $oferecimentoCCEx['codigoEdicaoCurso'] . 
                                        $oferecimentoCCEx['sequenciaOferecimento']
                                    )),
            'codigoCursoCEU' => $oferecimentoCCEx['codigoCursoCEU'],
            'situacaoOferecimento' => $oferecimentoCCEx['situacaoOferecimento'],
            'dataInicioOferecimento' => $oferecimentoCCEx['dataInicioOferecimento'],
            'dataFimOferecimento' => $oferecimentoCCEx['dataFimOferecimento'],
            'totalCargaHoraria' => ($oferecimentoCCEx['totalCargaHoraria'] / 60),
            'qntdVagasOfertadas' => $oferecimentoCCEx['qntdVagasOfertadas'],
            'cursoPago' => $oferecimentoCCEx['cursoPago'],
            'valorInscricaoEdicao' => $oferecimentoCCEx['valorInscricaoEdicao'],
            'qntdVagasGratuitas' => $oferecimentoCCEx['qntdVagasGratuitas'],
            'valorPrevistoArrecadacao' => $oferecimentoCCEx['valorPrevistoArrecadacao'],
            'valorPrevistoCustos' => $oferecimentoCCEx['valorPrevistoCustos'],
            'valorPrevistoPRCE' => $oferecimentoCCEx['valorPrevistoPRCE'],
            'cursoParaEmpresas' => $oferecimentoCCEx['cursoParaEmpresas'],
            'localCurso' => $oferecimentoCCEx['localCurso'],
            'dataInicioInscricoes' => $oferecimentoCCEx['dataInicioInscricoes'],
            'dataFimInscricoes' => $oferecimentoCCEx['dataFimInscricoes'],
            'permiteInscricaoOnline' => $oferecimentoCCEx['permiteInscricaoOnline'],
        ];

        return $properties;
    }
}