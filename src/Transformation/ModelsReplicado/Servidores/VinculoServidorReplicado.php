<?php

namespace Src\Transformation\ModelsReplicado\Servidores;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class VinculoServidorReplicado implements Mapper
{
    public function mapping(Array $vinculo)
    {
        $properties = [
            'id_vinculo' => strtoupper(
                md5(
                    $vinculo['numero_usp'] . 
                    $vinculo['sequencia_vinculo'] . 
                    $vinculo['vinculo']
                )
            ),
            'numero_usp' => $vinculo['numero_usp'],
            'vinculo' => Deparas::tiposVinculoServidores[$vinculo['vinculo']] ?? $vinculo['vinculo'],
            'situacao_atual' => Deparas::situacoesServidores[$vinculo['situacao_atual']] ?? $vinculo['situacao_atual'],
            'data_inicio_vinculo' => $vinculo['data_inicio_vinculo'],
            'data_fim_vinculo' => $vinculo['data_fim_vinculo'],
            'cod_ultimo_setor' => $vinculo['cod_ultimo_setor'],
            'nome_ultimo_setor' => $vinculo['nome_ultimo_setor'],
            'ambito_funcao' => $vinculo['ambito_funcao'],
            'classe' => $vinculo['classe'],
            'referencia' => $this->checkRef($vinculo['vinculo'], $vinculo['merito'], $vinculo['referencia']),
            'tipo_jornada' => $vinculo['tipo_jornada'],
            'tipo_ingresso' => $vinculo['tipo_ingresso'],
            'data_ultima_alteracao_funcional' => $vinculo['data_ultima_alteracao_funcional'],
            'ultima_ocorrencia' => $vinculo['ultima_ocorrencia'],
            'data_inicio_ultima_ocorrencia' => $vinculo['data_inicio_ultima_ocorrencia'],
        ];

        return $properties;
    }

    private function checkRef(string $vinculo, ?string $merito, ?string $referencia)
    {
        if ($vinculo == 'Docente') {
           return is_numeric($referencia) ? "$merito.$referencia" : $merito;
        }
        else {
            return $referencia;
        }
    }
}