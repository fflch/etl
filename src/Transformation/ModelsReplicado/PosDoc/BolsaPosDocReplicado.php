<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class BolsaPosDocReplicado implements Mapper
{
    public function mapping(Array $bolsaPD)
    {
        $bolsaPD = Utils::emptiesToNull($bolsaPD);

        $properties = [
            'idProjeto' => $bolsaPD['anoProjeto'] . '-' . $bolsaPD['codigoProjeto'],
            'sequenciaPeriodo' => $bolsaPD['sequenciaPeriodo'],
            'sequenciaFomento' => $bolsaPD['sequenciaFomento'],
            'codigoFomento' => $bolsaPD['codigoFomento'],
            'nomeFomento' => $bolsaPD['nomeFomento'],
            'dataInicioFomento' => $bolsaPD['dataInicioFomento'],
            'dataFimFomento' => $bolsaPD['dataFimFomento'],
            'idFomento' => $bolsaPD['idFomento'],
        ];

        return $properties;
    }
}