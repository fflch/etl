<?php

namespace Src\Transformation\ModelsReplicado\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;

class DisciplinaPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $disciplinaPG)
    {
        $properties = [
            'id_disciplina' => strtoupper(
                substr(
                    md5(
                        $disciplinaPG['codigo_disciplina'] .
                            $disciplinaPG['versao_disciplina']
                    ),
                    0,
                    8
                )
            ),
            'codigo_disciplina' => $disciplinaPG['codigo_disciplina'],
            'versao_disciplina' => $disciplinaPG['versao_disciplina'],
            'departamento' => $disciplinaPG['departamento'],
            'nome_disciplina' => CommonUtils::cleanInput(
                $disciplinaPG['nome_disciplina'],
                ['trim_quotes']
            ),
            'tipo_curso' => $disciplinaPG['tipo_curso'],
            'situacao_disciplina' => $disciplinaPG['situacao_disciplina'],
            'data_proposicao_disciplina' => $disciplinaPG['data_proposicao_disciplina'],
            'data_ativacao_disciplina' => $disciplinaPG['data_ativacao_disciplina'],
            'data_desativacao_disciplina' => $disciplinaPG['data_desativacao_disciplina'],
            'codigo_area' => $disciplinaPG['codigo_area'],
            'nome_area' => $disciplinaPG['nome_area'],
            'codigo_programa' => $disciplinaPG['codigo_programa'],
            'nome_programa' => $disciplinaPG['nome_programa'],
            'duracao_disciplina_semanas' => $disciplinaPG['duracao_disciplina_semanas'],
            'carga_horaria_teorica' => $disciplinaPG['carga_horaria_teorica'],
            'carga_horaria_pratica' => $disciplinaPG['carga_horaria_pratica'],
            'carga_horaria_estudo' => $disciplinaPG['carga_horaria_estudo'],
            'carga_horaria_total' => $disciplinaPG['carga_horaria_total'],
            'total_creditos' => $disciplinaPG['total_creditos'],
            'formato_disciplina' => $disciplinaPG['formato_disciplina'],
        ];

        return $properties;
    }
}
