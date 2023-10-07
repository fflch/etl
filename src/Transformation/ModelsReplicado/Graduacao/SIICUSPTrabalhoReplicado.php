<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;

class SIICUSPTrabalhoReplicado implements Mapper
{
    public function mapping(Array $trabalho)
    {
        $properties = [
            'id_trabalho' => $trabalho['edicao_siicusp'] . "-" . $trabalho['codigo_trabalho'],
            'titulo_trabalho' => CommonUtils::cleanInput(
                $trabalho['titulo_trabalho'],
                [
                    'decode_html',
                    'remove_trailing_periods',
                    'trim_quotes',
                    'to_uppercase'
                ]
            ),
            'id_projeto_ic' => isset($trabalho['codigo_projeto'])
                           ? $trabalho['ano_projeto'] . "-" . $trabalho['codigo_projeto']
                           : null,
            'edicao_siicusp' => $trabalho['edicao_siicusp'],
            'situacao_inscricao' => $trabalho['situacao_inscricao'],
            'situacao_apresentacao' => $this->checkSituacaoApresentacao(
                                                        $trabalho['apresentado_siicusp'], 
                                                        $trabalho['tipo_participante_apresentou']
                                    ),
            'prox_etapa_recomendado' => $trabalho['prox_etapa_recomendado'],
            'prox_etapa_apresentado' => $trabalho['prox_etapa_apresentado'],
            'mencao_honrosa' => $trabalho['mencao_honrosa'],
            'codigo_dpto_orientador' => $trabalho['codigo_dpto_orientador'],
            'nome_dpto_orientador' => $trabalho['nome_dpto_orientador'],
        ];

        return $properties;
    }

    
    private function checkSituacaoApresentacao(?string $apresentado, ?string $tipoParticipante)
    {
        if($tipoParticipante == 'F'){
            return 'Apresentador faltante';
        }
        elseif($tipoParticipante == 'J'){
            return 'Ausência justificada';
        }
        else{
            return Deparas::apresentacaoSIICUSP[$apresentado] ?? $apresentado;
        }
    }
}