<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

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

            'statusProjeto' => $this->checkStatus($iniciacao['statusProjeto'], $iniciacao['dataFimProjeto']),

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

    private function checkStatus(string $status, ?string $dataFimProjeto)
    {
        $today = date("Y-m-d");

        if($status == 'Ativo' && (strtotime($today) > strtotime($dataFimProjeto))){
            $novoStatus = 'Pendente';
            return $novoStatus;
        }
        else{
            return $status;
        }
    }
}