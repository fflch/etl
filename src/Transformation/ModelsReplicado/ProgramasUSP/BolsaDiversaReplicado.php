<?php

namespace Src\Transformation\ModelsReplicado\ProgramasUSP;

use Src\Transformation\Interfaces\Mapper;

class BolsaDiversaReplicado implements Mapper
{
    public function mapping(Array $bolsa)
    {
        $properties = [
            'id_bolsa_diversa' => strtoupper(substr(
                hash('sha256',
                    $bolsa['codigo_programa_usp'] . 
                    $bolsa['sequencia_programa_usp'] . 
                    $bolsa['periodo_referencial'] . 
                    $bolsa['numero_usp'] . 
                    $bolsa['data_inicio_bolsa'] .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            ),
            'codigo_programa_usp' => $bolsa['codigo_programa_usp'],
            'nome_programa_usp' => $bolsa['nome_programa_usp'],
            'numero_usp' => $bolsa['numero_usp'],
            'situacao_bolsa' => $bolsa['situacao_bolsa'],
            'data_inicio_bolsa' => $bolsa['data_inicio_bolsa'],
            'data_fim_bolsa' => $bolsa['data_fim_bolsa'],
            'justificativa_cancelamento_bolsa' => $bolsa['justificativa_cancelamento_bolsa'],
            'tipo_vinculo_bolsista' => $bolsa['tipo_vinculo_bolsista'],
            'id_graduacao_bolsista' => $this->getIdIfGraduacao(
                $bolsa['numero_usp'],
                $bolsa['sequencia_grad']
            ),
            'nivel_pg_bolsista' => $bolsa['nivel_pg_bolsista'],
            'id_inscricao_projeto' => $this->getIdIfProjeto(
                $bolsa['codigo_programa_usp'],
                $bolsa['sequencia_programa_usp'],
                $bolsa['periodo_referencial'],
                $bolsa['codigo_projeto_diverso'],
                $bolsa['numero_usp']
            ),
            'valor_bolsa_especifico' => $bolsa['valor_bolsa_especifico'],
        ];

        return $properties;
    }

    private function getIdIfGraduacao($numero_usp, $sequencia_grad)
    {
        if (!empty($sequencia_grad)) {
            return strtoupper(substr(
                hash('sha256',
                    $numero_usp . 
                    $sequencia_grad .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            );
        }
        
        return null;
    }

    private function getIdIfProjeto(
        $codigo_bolsa,
        $numero_sequencial_bolsa,
        $periodo_referencial,
        $codigo_projeto_diverso,
        $numero_usp
    )
    {
        if(!empty($codigo_projeto_diverso))
        {
            return strtoupper(substr(
                hash('sha256',
                    $codigo_bolsa . 
                    $numero_sequencial_bolsa . 
                    $periodo_referencial . 
                    $codigo_projeto_diverso .
                    $numero_usp .
                    $_ENV['ETL_HASH_PEPPER']
                ), 0, 32)
            );
        }

        return null;
    }
}