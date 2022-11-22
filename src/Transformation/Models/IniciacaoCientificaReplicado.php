<?php

namespace Src\Transformation\Models;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Models\Interfaces\Mapper;

class IniciacaoCientificaReplicado implements Mapper
{
    public function mapping(Array $iniciacao)
    {
        $iniciacao = Utils::emptiesToNull($iniciacao);

        $properties = [
            'idProjeto' => ($iniciacao['anoProjeto'] . '-' . $iniciacao['codigoProjeto']),
            'numeroUSP' => !is_null($iniciacao['numeroUSP'])
                           ? (int)$iniciacao['numeroUSP']
                           : NULL,
            'statusProjeto' => $iniciacao['statusProjeto'],
            'codigoDepartamento' => (int)$iniciacao['codigoDepartamento'],
            'nomeDepartamento' => $iniciacao['nomeDepartamento'],
            'anoProjeto' => $iniciacao['anoProjeto'],
            'dataInicioProjeto' => $iniciacao['dataInicioProjeto'],
            'dataFimProjeto' => $iniciacao['dataFimProjeto'],
            'numeroUSPorientador' => (int)$iniciacao['numeroUSPorientador'],
            'tituloProjeto' => $iniciacao['tituloProjeto'],
            'palavrasChave' => $iniciacao['palavrasChave']
        ];

        return $properties;
    }
}