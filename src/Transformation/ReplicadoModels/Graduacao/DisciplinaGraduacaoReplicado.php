<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Utils\Deparas;
use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;
use Src\Utils\ReplicadoModelsUtils;

class DisciplinaGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_disciplina' => ReplicadoModelsUtils::getDisciplinaGraduacaoId($record),
            'codigo_disciplina' => $record['codigo_disciplina'],
            'versao_disciplina' => $record['versao_disciplina'],
            'nome_disciplina' => CommonUtils::cleanInput(
                $record['nome_disciplina'],
                ['trim_quotes']
            ),
            'situacao_disciplina' => Deparas::situacoesDisciplina[$record['situacao_disciplina']]
                ?? $record['situacao_disciplina'],
            'data_ativacao_disciplina' => $record['data_ativacao_disciplina'],
            'data_desativacao_disciplina' => $record['data_desativacao_disciplina'],
            'credito_aula' => $record['credito_aula'],
            'credito_trabalho' => $record['credito_trabalho'],
            'duracao_disciplina_semanas' => $record['duracao_disciplina_semanas'],
            'periodicidade_disciplina' => Deparas::periodicidadeDisciplina[$record['periodicidade_disciplina']]
                ?? $record['periodicidade_disciplina'],
            'carga_horaria_estagio' => $record['carga_horaria_estagio'],
            'carga_horaria_licenciatura' => $record['carga_horaria_licenciatura'],
            'carga_horaria_aacc' => $record['carga_horaria_aacc'],
        ];

        return $properties;
    }
}
