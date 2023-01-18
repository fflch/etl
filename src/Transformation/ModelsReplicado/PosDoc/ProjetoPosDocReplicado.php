<?php

namespace Src\Transformation\ModelsReplicado\PosDoc;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class ProjetoPosDocReplicado implements Mapper
{
    public function mapping(Array $projetoPosDoc)
    {
        $projetoPosDoc = Utils::emptiesToNull($projetoPosDoc);

        $properties = [
            'idProjeto' => $projetoPosDoc['anoProjeto'] . '-' . $projetoPosDoc['codigoProjeto'],
            'programa' => Deparas::modalidadesPD[$projetoPosDoc['codigoModalidade']] ?? 'XX',
            'numeroUSP' => $projetoPosDoc['numeroUSP'],
            'dataInicioProjeto' => $projetoPosDoc['dataInicioProjeto'],
            'dataFimProjeto' => $projetoPosDoc['dataFimProjeto'],
            'situacaoProjeto' => $projetoPosDoc['situacaoProjeto'],
            'codigoDepartamento' => $projetoPosDoc['codigoDepartamento'],
            'nomeDepartamento' => $projetoPosDoc['nomeDepartamento'],
            'tituloProjeto' => $projetoPosDoc['tituloProjeto'],
            'palavrasChave' => $this->palavrasChave(
                                                    array(
                                                        $projetoPosDoc['palcha1'],
                                                        $projetoPosDoc['palcha2'],
                                                        $projetoPosDoc['palcha3']
                                                    )),
        ];

        return $properties;
    }

    private function palavrasChave(array $palavras)
    {
        $palavrasChave = array_filter($palavras, function ($palavra) { return !empty($palavra); });

        return mb_strtoupper(implode("; ", $palavrasChave), 'UTF-8');
    }
}