<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class SIICUSPTrabalhoReplicado implements Mapper
{
    public function mapping(Array $trabalho)
    {
        $trabalho = Utils::emptiesToNull($trabalho);

        $properties = [
            'id_trabalho' => $trabalho['edicao_siicusp'] . "-" . $trabalho['codigo_trabalho'],
            'titulo_trabalho' => $trabalho['titulo_trabalho'],
            'id_projeto_ic' => isset($trabalho['codigo_projeto'])
                           ? $trabalho['ano_projeto'] . "-" . $trabalho['codigo_projeto']
                           : null,
            'edicao_siicusp' => $trabalho['edicao_siicusp'],
            'situacao_inscricao' => $trabalho['situacao_inscricao'],
            'situacao_apresentacao' => $this->checkSituacaoApresentacao(
                                                        $trabalho['apresentado_siicusp'], 
                                                        $trabalho['tipo_participante_apresentou']
                                    ),
            'prox_etapa_recomendado' => Deparas::boolSIICUSP[$trabalho['prox_etapa_recomendado']] ?? false,
            'prox_etapa_apresentado' => Deparas::boolSIICUSP[$trabalho['prox_etapa_apresentado']] ?? false,
            'mencao_honrosa' => Deparas::boolSIICUSP[$trabalho['mencao_honrosa']] ?? false,
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