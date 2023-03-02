<?php

namespace Src\Transformation\ModelsReplicado\Servidores;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class VinculoServidorReplicado implements Mapper
{
    public function mapping(Array $vinculo)
    {
        $vinculo = Utils::emptiesToNull($vinculo);

        $properties = [
            'numero_usp' => $vinculo['numero_usp'],
            'numero_sequencia_vinculo' => $vinculo['numero_sequencia_vinculo'],
            'tipo_vinculo' => Deparas::tiposVinculoServidores[$vinculo['tipo_vinculo']] ?? $vinculo['tipo_vinculo'],
            'data_inicio_vinculo' => $vinculo['data_inicio_vinculo'],
            'data_fim_vinculo' => $vinculo['data_fim_vinculo'],
            'situacao_atual' => Deparas::situacoesServidores[$vinculo['situacao_atual']] ?? $vinculo['situacao_atual'],
            'cod_ultimo_setor' => $vinculo['cod_ultimo_setor'],
            'nome_ultimo_setor' => $vinculo['nome_ultimo_setor'],
            'tipo_ingresso' => $vinculo['tipo_ingresso'],
            'ultima_ocorrencia' => $vinculo['ultima_ocorrencia'],
            'data_inicio_ultima_ocorrencia' => $vinculo['data_inicio_ultima_ocorrencia'],
            'nome_carreira' => $vinculo['nome_carreira'],
            'nome_funcao' => $vinculo['nome_funcao'],
            'nome_classe' => $vinculo['nome_classe'],
            'nome_grau_provimento' => $vinculo['nome_grau_provimento'],
            'data_ultima_alteracao_funcional' => $vinculo['data_ultima_alteracao_funcional'],
            'cargo' => Deparas::funcoesDesignadas[$vinculo['cargo']] ?? $vinculo['cargo'],
            'tipo_jornada' => $vinculo['tipo_jornada'],
            'tipo_condicao' => $vinculo['tipo_condicao']
        ];

        return $properties;
    }
}