<?php

namespace Src\Transformation\ModelsReplicado\Lattes;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;
use Uspdev\Replicado\Uteis;

class LattesReplicado implements Mapper
{
    public function mapping(Array $cvlattes)
    {
        $cvlattes = Utils::emptiesToNull($cvlattes);

        $properties = [
            'numero_cnpq' => (int) $cvlattes['numero_cnpq'],
            'numero_usp' => $cvlattes['numero_usp'],
            'data_atualizacao_cv' => $cvlattes['data_atualizacao_cv'],
            'data_extracao_cv' => $cvlattes['data_extracao_cv'],
            'updated_here_at' => date("Y-m-d H:i:s"),
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

        $dadosLattes = Utils::extracaoDadosLattes($array);

        return json_encode($dadosLattes);
    }
}