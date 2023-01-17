<?php

namespace Src\Transformation\ModelsReplicado\PosDoutorado;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class PosDoutoradoReplicado implements Mapper
{
    public function mapping(Array $posDoutorado)
    {
        $posDoutorado = Utils::emptiesToNull($posDoutorado);

        $properties = [
            'idProjeto' => $posDoutorado['anoProjeto'] . '-' . $posDoutorado['codigoProjeto'],
            'programa' => Deparas::modalidadesPD[$posDoutorado['codigoModalidade']] ?? 'XX',
            'numeroUSP' => $posDoutorado['numeroUSP'],
            'dataInicioProjeto' => $posDoutorado['dataInicioProjeto'],
            'dataFimProjeto' => $posDoutorado['dataFimProjeto'],
            'situacaoProjeto' => $posDoutorado['situacaoProjeto'],
            'codigoDepartamento' => $posDoutorado['codigoDepartamento'],
            'nomeDepartamento' => $posDoutorado['nomeDepartamento'],
            'tituloProjeto' => $posDoutorado['tituloProjeto'],
        ];

        return $properties;
    }
}