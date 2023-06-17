<?php

namespace Src\Transformation\ModelsReplicado\CEU;

use Src\Utils\TransformationUtils;
use Src\Transformation\Interfaces\Mapper;

class CoordenadorCCExReplicado implements Mapper
{
    public function mapping(Array $coordenadorCCEx)
    {
        $properties = [
            'numero_usp' => $coordenadorCCEx['numero_usp'],
            'codigo_oferecimento' => strtoupper(
                                        md5(
                                            $coordenadorCCEx['codigo_curso_ceu'] . 
                                            $coordenadorCCEx['codigo_edicao_curso'] . 
                                            $coordenadorCCEx['sequencia_oferecimento']
                                        )
                                    ),
            'funcao' => $coordenadorCCEx['funcao'],
            'forma_exercicio' => $coordenadorCCEx['forma_exercicio'], //ver
        ];

        return $properties;
    }
}