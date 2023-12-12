<?php

namespace Src\Transformation\ModelsReplicado\PesquisasAvancadas;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;

class PesquisaAvancadaReplicado implements Mapper
{
    public function mapping(Array $pesquisa_avancada)
    {
        $properties = [
            'id_projeto' => $pesquisa_avancada['ano_projeto'] . '-' . $pesquisa_avancada['codigo_projeto'],
            'modalidade' => Deparas::modalidadesPD[$pesquisa_avancada['codigo_modalidade']] ?? 'XX',
            'numero_usp' => $pesquisa_avancada['numero_usp'],
            'situacao_projeto' => $pesquisa_avancada['situacao_projeto'],
            'data_inicio_projeto' => $pesquisa_avancada['data_inicio_projeto'],
            'data_fim_projeto' => $pesquisa_avancada['data_fim_projeto'],
            'motivo_cancelamento' => $pesquisa_avancada['motivo_cancelamento'],
            'descricao_cancelamento' => $pesquisa_avancada['descricao_cancelamento'],
            'codigo_departamento' => $pesquisa_avancada['codigo_departamento'],
            'nome_departamento' => $pesquisa_avancada['nome_departamento'],
            'titulo_projeto' => CommonUtils::cleanInput(
                $pesquisa_avancada['titulo_projeto'],
                [
                    'decode_html', 
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
            'area_cnpq' => $pesquisa_avancada['area_cnpq'],
            'palavras_chave' => $this->palavrasChave(
                                                    array(
                                                        $pesquisa_avancada['palcha_1'],
                                                        $pesquisa_avancada['palcha_2'],
                                                        $pesquisa_avancada['palcha_3']
                                                    )),
        ];

        return $properties;
    }

    private function palavrasChave(array $palavras)
    {
        $palavrasChave = array_filter($palavras, function ($palavra) { return !empty($palavra); });

        return CommonUtils::cleanInput(
            implode("; ", $palavrasChave),
            ['decode_html', 'to_uppercase']
        );
    }
}