<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;

class CoordenadorPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $coordenadorPG)
    {
        $properties = [
            'numero_usp' => $coordenadorPG['numero_usp'],
            'funcao' => $coordenadorPG['funcao'],
            'codigo_programa' => $coordenadorPG['codigo_programa'],
            'nome_programa' => $coordenadorPG['nome_programa'],
            'data_inicio_funcao' => $coordenadorPG['data_inicio_funcao'],
            'data_fim_funcao' => $coordenadorPG['data_fim_funcao'],
        ];

        return $properties;
    }
}