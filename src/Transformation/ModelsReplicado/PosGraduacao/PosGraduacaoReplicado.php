<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class PosGraduacaoReplicado implements Mapper
{
    public function mapping(Array $posGraduacao)
    {
        $posGraduacao = Utils::emptiesToNull($posGraduacao);

        $properties = [
            'idPosGraduacao' => strtoupper(md5($posGraduacao['numeroUSP'] . 
                                               $posGraduacao['seqPrograma'] .
                                               $posGraduacao['codigoArea']
                                          )),
            'numeroUSP' => $posGraduacao['numeroUSP'],
            'seqPrograma' => $posGraduacao['seqPrograma'],
            'codigoArea' => $posGraduacao['codigoArea'],
            'nomeArea' => $posGraduacao['nomeArea'],
            'codigoPrograma' => $posGraduacao['codigoPrograma'],
            'nomePrograma' => $posGraduacao['nomePrograma'],
            'dataSelecao' => $posGraduacao['dataSelecao'],
            'primeiraMatricula' => $posGraduacao['primeiraMatricula'],
            'tipoUltimaOcorrencia' => $posGraduacao['tipoUltimaOcorrencia'],
            'dataUltimaOcorrencia' => $posGraduacao['dataUltimaOcorrencia'],
            'nivelPrograma' => $posGraduacao['nivelPrograma'],
            'dataDepositoTrabalho' => $posGraduacao['dataDepositoTrabalho'],
            'dataAprovacaoTrabalho' => $posGraduacao['dataAprovacaoTrabalho'],
        ];

        return $properties;
    }
}