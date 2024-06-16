<?php

namespace Src\Transformation\ReplicadoModels\Lattes;

use Src\Transformation\Interfaces\Mapper;
use Uspdev\Replicado\Uteis;
use Src\Utils\TransformationUtils;

class LattesReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_cnpq' => (int) $record['numero_cnpq'],
            'numero_usp' => $record['numero_usp'],
            'data_atualizacao_cv' => $record['data_atualizacao_cv'],
            'data_extracao_cv' => $record['data_extracao_cv'],
            'lattes' => $this->obterJson($record['xml_zipped'])
        ];

        return $properties;
    }

    private function obterJson($zipData)
    {

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
