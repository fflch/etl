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
            'codigo_oferecimento' => strtoupper(md5(
                                        $inscricaoCCEx['codigo_curso_ceu'] . 
                                        $inscricaoCCEx['codigo_edicao_curso'] . 
                                        $inscricaoCCEx['sequencia_oferecimento']
                                    )),
            'numero_ceu' => $inscricaoCCEx['numero_ceu'],
            'data_inscricao' => $inscricaoCCEx['data_inscricao'],
            'situacao_inscricao' => $inscricaoCCEx['situacao_inscricao'],
            'origem_inscricao' => $inscricaoCCEx['origem_inscricao'],
        ];

        return $properties;
    }
}