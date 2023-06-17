<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\TransformationUtils;
use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;

class IniciacaoCientificaReplicado implements Mapper
{
    public function mapping(Array $iniciacao)
    {
        $properties = [
            'id_projeto' => ($iniciacao['ano_projeto'] . '-' . $iniciacao['codigo_projeto']),
            'numero_usp' => !is_null($iniciacao['numero_usp'])
                           ? (int)$iniciacao['numero_usp']
                           : NULL,
            'data_inicio_projeto' => $iniciacao['data_inicio_projeto'],
            'data_fim_projeto' => $iniciacao['data_fim_projeto'],
            'situacao_projeto' => $this->checkStatus($iniciacao['situacao_projeto'], $iniciacao['data_fim_projeto']),
            'codigo_departamento' => (int)$iniciacao['codigo_departamento'],
            'nome_departamento' => $iniciacao['nome_departamento'],
            'ano_projeto' => $iniciacao['ano_projeto'],
            'numero_usp_orientador' => (int)$iniciacao['numero_usp_orientador'],
            'titulo_projeto' => $iniciacao['titulo_projeto'],
            'palavras_chave' => $iniciacao['palavras_chave']
        ];

        return $properties;
    }

    private function checkStatus(string $situacao, ?string $dataFimProjeto)
    {
        $situacao = Deparas::statusProjeto[$situacao] ?? $situacao;

        $today = date("Y-m-d H:i:s");

        if($situacao == 'Ativo' && (strtotime($today) > strtotime($dataFimProjeto))){
            return 'Pendente';
        }

        return $situacao;
    }
}