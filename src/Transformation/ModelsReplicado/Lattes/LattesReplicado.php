<?php

namespace Src\Transformation\ModelsReplicado\Lattes;

use Src\Transformation\Interfaces\Mapper;
use Uspdev\Replicado\Uteis;
use Src\Utils\TransformationUtils;

class LattesReplicado implements Mapper
{
    public function mapping(Array $cvlattes)
    {
        $properties = [
            'numero_cnpq' => (int) $cvlattes['numero_cnpq'],
            'numero_usp' => $cvlattes['numero_usp'],
            'data_atualizacao_cv' => $cvlattes['data_atualizacao_cv'],
            'data_extracao_cv' => $cvlattes['data_extracao_cv'],
            'lattes' => $this->obterJson($cvlattes['xml_zipped'])
        ];

        return $properties;
    }

    private function obterJson($zipData){

        $xml = Uteis::unzip($zipData);

        if (!$xml) {
            return null;
        }

        $json = json_encode(simplexml_load_string($xml));
        $array = json_decode($json, true);

        $dadosLattes = TransformationUtils::extracaoDadosLattes($array);

        return json_encode($dadosLattes);
    }
}