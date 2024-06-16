<?php

namespace Src\Transformation\ReplicadoModels\PosGraduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class DisciplinaPosGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_disciplina' => ReplicadoModelsUtils::getDisciplinaPosGraduacaoId($record),
            'codigo_disciplina' => $record['codigo_disciplina'],
            'versao_disciplina' => $record['versao_disciplina'],
            'departamento' => $record['departamento'],
            'nome_disciplina' => CommonUtils::cleanInput(
                $record['nome_disciplina'],
                ['trim_quotes']
            ),
            'tipo_curso' => $record['tipo_curso'],
            'situacao_disciplina' => $record['situacao_disciplina'],
            'data_proposicao_disciplina' => $record['data_proposicao_disciplina'],
            'data_ativacao_disciplina' => $record['data_ativacao_disciplina'],
            'data_desativacao_disciplina' => $record['data_desativacao_disciplina'],
            'codigo_area' => $record['codigo_area'],
            'nome_area' => $record['nome_area'],
            'codigo_programa' => $record['codigo_programa'],
            'nome_programa' => $record['nome_programa'],
            'duracao_disciplina_semanas' => $record['duracao_disciplina_semanas'],
            'carga_horaria_teorica' => $record['carga_horaria_teorica'],
            'carga_horaria_pratica' => $record['carga_horaria_pratica'],
            'carga_horaria_estudo' => $record['carga_horaria_estudo'],
            'carga_horaria_total' => $record['carga_horaria_total'],
            'total_creditos' => $record['total_creditos'],
            'formato_disciplina' => $record['formato_disciplina'],
        ];

        return $properties;
    }
}
