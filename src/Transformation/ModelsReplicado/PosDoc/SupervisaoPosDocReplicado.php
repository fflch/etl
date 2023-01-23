<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class SupervisaoPosDocReplicado implements Mapper
{
    public function mapping(Array $supervisaoPD)
    {
        $supervisaoPD = Utils::emptiesToNull($supervisaoPD);

        $properties = [
            'idProjeto' => $supervisaoPD['anoProjeto'] . '-' . $supervisaoPD['codigoProjeto'],
            'sequenciaSupervisao' => $supervisaoPD['order'],
            'numeroUSPSupervisor' => $supervisaoPD['numeroUSPSupervisor'],
            'tipoSupervisao' => $supervisaoPD['tipoSupervisao'],
            'dataInicioSupervisao' => $supervisaoPD['dataInicioSupervisao'],
            'dataFimSupervisao' => $supervisaoPD['dataFimSupervisao'],
        ];

        return $properties;
    }
}