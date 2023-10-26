<?php

namespace Src\Transformation\ModelsReplicado\Beneficios;

use Src\Transformation\Interfaces\Mapper;

class BeneficioConcedidoReplicado implements Mapper
{
    public function mapping(Array $beneficio)
    {
        $properties = [
            'id_concessao_beneficio' => strtoupper(substr(
                hash('sha256',
                    $beneficio['codigo_beneficio'] . 
                    $beneficio['numero_sequencial_beneficio'] . 
                    $beneficio['periodo_projeto_beneficio'] . 
                    $beneficio['numero_usp'] . 
                    $beneficio['data_inicio_concessao'] .
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            ),
            'codigo_beneficio' => $beneficio['codigo_beneficio'],
            'nome_beneficio' => $beneficio['nome_beneficio'],
            'tipo_beneficio' => $beneficio['tipo_beneficio'],
            'tipo_vinculo' => $beneficio['tipo_vinculo'],
            'numero_usp' => $beneficio['numero_usp'],
            'id_graduacao' => $this->getIdIfGraduacao(
                $beneficio['numero_usp'],
                $beneficio['sequencia_grad']
            ),
            'nivel_pos_graduacao' => $beneficio['nivel_pos_graduacao'],
            'data_inicio_concessao' => $beneficio['data_inicio_concessao'],
            'data_fim_concessao' => $beneficio['data_fim_concessao'],
            'situacao_beneficio' => $beneficio['situacao_beneficio'],
            'justificativa_cancelamento_concessao' => $beneficio['justificativa_cancelamento_concessao'],
            'id_projeto_beneficio' => $this->getIdIfProjetoBeneficio(
                $beneficio['codigo_beneficio'],
                $beneficio['numero_sequencial_beneficio'], 
                $beneficio['periodo_projeto_beneficio'],
                $beneficio['codigo_projeto_beneficio']
            ),
            'cota_mensal_prevista' => $beneficio['cota_mensal_prevista'],
            'valor_beneficio_especifico' => $beneficio['valor_beneficio_especifico'],
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
                    $_ENV['HASH_PEPPER']
                ), 0, 32)
            );
        }
        
        return null;
    }

    private function getIdIfProjetoBeneficio(
        $codigo_beneficio,
        $numero_sequencial_beneficio,
        $periodo_projeto_beneficio,
        $codigo_projeto_beneficio
    )
    {
        if(!empty($codigo_projeto_beneficio))
        {
            return strtoupper(substr(md5(
                $codigo_beneficio . 
                $numero_sequencial_beneficio . 
                $periodo_projeto_beneficio . 
                $codigo_projeto_beneficio
            ), 0, 12));
        }

        return null;
    }
}