<?php

namespace Src\Transformation\ModelsReplicado\Graduacao;

use Src\Transformation\Utils\Utils;
use Src\Transformation\ModelsReplicado\Interfaces\Mapper;

class DemandaTurmaGraduacaoReplicado implements Mapper
{
    public function mapping(Array $demandaTurma)
    {
        $demandaTurma = Utils::emptiesToNull($demandaTurma);

        $properties = [
            'codigo_disciplina' => $demandaTurma['codigo_disciplina'],
            'versao_disciplina' => $demandaTurma['versao_disciplina'],
            'codigo_turma' => $demandaTurma['codigo_turma'],
            'vagas_total' => $demandaTurma['vagas_total'],
            'inscritos_total' => $demandaTurma['inscritos_total'],
            'matriculados_total' => $demandaTurma['matriculados_total'],
            'vagas_tipo_obrigatoria' => $demandaTurma['vagas_tipo_obrigatoria'],
            'inscritos_tipo_obrigatoria' => $demandaTurma['inscritos_tipo_obrigatoria'],
            'matriculados_tipo_obrigatoria' => $demandaTurma['matriculados_tipo_obrigatoria'],
            'vagas_tipo_opt_eletiva' => $demandaTurma['vagas_tipo_opt_eletiva'],
            'inscritos_tipo_opt_eletiva' => $demandaTurma['inscritos_tipo_opt_eletiva'],
            'matriculados_tipo_opt_eletiva' => $demandaTurma['matriculados_tipo_opt_eletiva'],
            'vagas_tipo_opt_livre' => $demandaTurma['vagas_tipo_opt_livre'],
            'inscritos_tipo_opt_livre' => $demandaTurma['inscritos_tipo_opt_livre'],
            'matriculados_tipo_opt_livre' => $demandaTurma['matriculados_tipo_opt_livre'],
            'vagas_tipo_extracurricular' => $demandaTurma['vagas_tipo_extracurricular'],
            'inscritos_tipo_extracurricular' => $demandaTurma['inscritos_tipo_extracurricular'],
            'matriculados_tipo_extracurricular' => $demandaTurma['matriculados_tipo_extracurricular'],
            'vagas_tipo_especial' => $demandaTurma['vagas_tipo_especial'],
            'inscritos_tipo_especial' => $demandaTurma['inscritos_tipo_especial'],
            'matriculados_tipo_especial' => $demandaTurma['matriculados_tipo_especial'],
        ];

        return $properties;
    }
}