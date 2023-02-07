<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class InscricaoCCExReplicado implements Mapper
{
    public function mapping(Array $inscricaoCCEx)
    {
        $inscricaoCCEx = Utils::emptiesToNull($inscricaoCCEx);

        $properties = [
            'codigoOferecimento' => strtoupper(md5(
                                        $inscricaoCCEx['codigoCursoCEU'] . 
                                        $inscricaoCCEx['codigoEdicaoCurso'] . 
                                        $inscricaoCCEx['sequenciaOferecimento']
                                    )),
            'numeroCEU' => $inscricaoCCEx['numeroCEU'],
            'dataInscricao' => $inscricaoCCEx['dataInscricao'],
            'situacaoInscricao' => $inscricaoCCEx['situacaoInscricao'],
            'origemInscricao' => $inscricaoCCEx['origemInscricao'],
        ];

        return $properties;
    }
}