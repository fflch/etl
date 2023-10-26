<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class InscricaoCCExReplicado implements Mapper
{
    public function mapping(Array $inscricaoCCEx)
    {
        $properties = [
            'codigo_oferecimento' => strtoupper(md5(
                $inscricaoCCEx['codigo_curso_ceu'] . 
                $inscricaoCCEx['codigo_edicao_curso'] . 
                $inscricaoCCEx['sequencia_oferecimento']
            )),
            'numero_ceu' => $inscricaoCCEx['numero_ceu'],
            'data_inscricao' => $inscricaoCCEx['data_inscricao'],
            'situacao_inscricao' => Deparas::situacoesInscricaoCCEx[$inscricaoCCEx['situacao_inscricao']]
                                    ?? $inscricaoCCEx['situacao_inscricao'],
            'origem_inscricao' => Deparas::origensInscricaoCCex[$inscricaoCCEx['origem_inscricao']]
                                  ?? $inscricaoCCEx['origem_inscricao'],
        ];

        return $properties;
    }
}