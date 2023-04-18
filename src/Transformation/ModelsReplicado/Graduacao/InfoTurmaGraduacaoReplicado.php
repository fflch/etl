<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\Utils\Deparas;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class InfoTurmaGraduacaoReplicado implements Mapper
{
    public function mapping(Array $turmaInfo)
    {
        $turmaInfo = Utils::emptiesToNull($turmaInfo);

        $properties = [
            'codigo_disciplina' => $turmaInfo['codigo_disciplina'],
            'versao_disciplina' => $turmaInfo['versao_disciplina'],
            'codigo_turma' => $turmaInfo['codigo_turma'],
            'vagas_total' => $turmaInfo['vagas_total'],
            'inscritos_total' => $turmaInfo['inscritos_total'],
            'matriculados_total' => $turmaInfo['matriculados_total'],
            'vagas_tipo_obrigatoria' => $turmaInfo['vagas_tipo_obrigatoria'],
            'inscritos_tipo_obrigatoria' => $turmaInfo['inscritos_tipo_obrigatoria'],
            'matriculados_tipo_obrigatoria' => $turmaInfo['matriculados_tipo_obrigatoria'],
            'vagas_tipo_opt_eletiva' => $turmaInfo['vagas_tipo_opt_eletiva'],
            'inscritos_tipo_opt_eletiva' => $turmaInfo['inscritos_tipo_opt_eletiva'],
            'matriculados_tipo_opt_eletiva' => $turmaInfo['matriculados_tipo_opt_eletiva'],
            'vagas_tipo_opt_livre' => $turmaInfo['vagas_tipo_opt_livre'],
            'inscritos_tipo_opt_livre' => $turmaInfo['inscritos_tipo_opt_livre'],
            'matriculados_tipo_opt_livre' => $turmaInfo['matriculados_tipo_opt_livre'],
            'vagas_tipo_extracurricular' => $turmaInfo['vagas_tipo_extracurricular'],
            'inscritos_tipo_extracurricular' => $turmaInfo['inscritos_tipo_extracurricular'],
            'matriculados_tipo_extracurricular' => $turmaInfo['matriculados_tipo_extracurricular'],
            'vagas_tipo_especial' => $turmaInfo['vagas_tipo_especial'],
            'inscritos_tipo_especial' => $turmaInfo['inscritos_tipo_especial'],
            'matriculados_tipo_especial' => $turmaInfo['matriculados_tipo_especial'],
        ];

        return $properties;
    }
}