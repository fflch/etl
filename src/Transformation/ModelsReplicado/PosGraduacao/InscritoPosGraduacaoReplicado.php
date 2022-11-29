<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class InscritoPosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $inscritoPG)
    {
        $inscritoPG = Utils::emptiesToNull($inscritoPG);

        $properties = [
            'idInscricao' => strtoupper(md5($inscritoPG['numeroUSP'] . 
                                            $inscritoPG['seqPrograma'] .
                                            $inscritoPG['codigoArea']
                                        )),
            'numeroUSP' => $inscritoPG['numeroUSP'],
            'seqPrograma' => $inscritoPG['seqPrograma'],
            'codigoArea' => $inscritoPG['codigoArea'],
            'dataInscricao' => $inscritoPG['dataInscricao'],
            'nivelInscricao' => $inscritoPG['nivelInscricao'],
            'resultadoInscricao' => $inscritoPG['resultadoInscricao'],
        ];

        return $properties;
    }
}