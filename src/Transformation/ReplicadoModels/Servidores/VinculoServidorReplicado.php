<?php

namespace Src\Transformation\ReplicadoModels\Servidores;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\Deparas;
use Src\Utils\ReplicadoModelsUtils;

class VinculoServidorReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_vinculo' => ReplicadoModelsUtils::getVinculoId($record),
            'numero_usp' => $record['numero_usp'],
            'vinculo' => Deparas::tiposVinculoServidores[$record['vinculo']]
                ?? $record['vinculo'],
            'situacao_atual' => Deparas::situacoesServidores[$record['situacao_atual']]
                ?? $record['situacao_atual'],
            'data_inicio_vinculo' => $record['data_inicio_vinculo'],
            'data_fim_vinculo' => $record['data_fim_vinculo'],
            'cod_ultimo_setor' => $record['cod_ultimo_setor'],
            'nome_ultimo_setor' => $record['nome_ultimo_setor'],
            'ambito_funcao' => $record['ambito_funcao'],
            'classe' => $record['classe'],
            'referencia' => $this->getRef(
                $record['vinculo'],
                $record['merito'],
                $record['referencia']
            ),
            'tipo_jornada' => $record['tipo_jornada'],
            'tipo_ingresso' => $record['tipo_ingresso'],
            'data_ultima_alteracao_funcional' => $record['data_ultima_alteracao_funcional'],
            'ultima_ocorrencia' => $record['ultima_ocorrencia'],
            'data_inicio_ultima_ocorrencia' => $record['data_inicio_ultima_ocorrencia'],
        ];

        return $properties;
    }

    private function getRef(string $record, ?string $merito, ?string $referencia)
    {
        if ($record === 'Docente') {
            return is_numeric($referencia)
                ? "$merito.$referencia"
                : $merito;
        } else {
            return $referencia;
        }
    }
}
