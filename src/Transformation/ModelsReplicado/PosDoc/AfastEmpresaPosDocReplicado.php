<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class AfastEmpresaPosDocReplicado implements Mapper
{
    public function mapping(Array $afastamento)
    {
        $afastamento = Utils::emptiesToNull($afastamento);

        $properties = [
            'idProjeto' => $afastamento['anoProjeto'] . '-' . $afastamento['codigoProjeto'],
            'sequenciaPeriodo' => $afastamento['sequenciaPeriodo'],
            'seqVinculoEmpresa' => $afastamento['seqVinculoEmpresa'],
            'nomeEmpresa' => $afastamento['nomeEmpresa'],
            'dataInicioAfastamento' => $afastamento['dataInicioAfastamento'],
            'dataFimAfastamento' => $afastamento['dataFimAfastamento'],
            'tipoVinculo' => Deparas::tiposVinculoPD[$afastamento['tipoVinculo']] ?? $afastamento['tipoVinculo'],
        ];

        return $properties;
    }
}