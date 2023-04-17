<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class DisciplinaGraduacaoReplicado implements Mapper
{
    public function mapping(Array $disciplina)
    {
        $disciplina = Utils::emptiesToNull($disciplina);

        $properties = [
            'codigo_disciplina' => $disciplina['codigo_disciplina'],
            'versao_disciplina' => $disciplina['versao_disciplina'],
            'nome_disciplina' => $disciplina['nome_disciplina'],
            'credito_aula' => $disciplina['credito_aula'],
            'credito_trabalho' => $disciplina['credito_trabalho'],
            'data_ativacao_disciplina' => $disciplina['data_ativacao_disciplina'],
            'data_desativacao_disciplina' => $disciplina['data_desativacao_disciplina'],
            'duracao_disciplina_semanas' => $disciplina['duracao_disciplina_semanas'],
            'periodicidade_disciplina' => $disciplina['periodicidade_disciplina'],
            'carga_horaria_estagio' => $disciplina['carga_horaria_estagio'],
            'carga_horaria_licenciatura' => $disciplina['carga_horaria_licenciatura'],
            'carga_horaria_aacc' => $disciplina['carga_horaria_aacc'],
            'situacao_disciplina' => $disciplina['situacao_disciplina'],
        ];

        return $properties;
    }
}