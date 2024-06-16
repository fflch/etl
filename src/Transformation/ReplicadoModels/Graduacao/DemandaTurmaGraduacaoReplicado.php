<?php

namespace Src\Transformation\ReplicadoModels\Graduacao;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\ReplicadoModelsUtils;

class DemandaTurmaGraduacaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'id_turma' => ReplicadoModelsUtils::getTurmaGraduacaoId($record),
            'vagas_total' => $record['vagas_total'],
            'inscritos_total' => $record['inscritos_total'],
            'matriculados_total' => $record['matriculados_total'],
            'vagas_tipo_obrigatoria' => $record['vagas_tipo_obrigatoria'],
            'inscritos_tipo_obrigatoria' => $record['inscritos_tipo_obrigatoria'],
            'matriculados_tipo_obrigatoria' => $record['matriculados_tipo_obrigatoria'],
            'vagas_tipo_opt_eletiva' => $record['vagas_tipo_opt_eletiva'],
            'inscritos_tipo_opt_eletiva' => $record['inscritos_tipo_opt_eletiva'],
            'matriculados_tipo_opt_eletiva' => $record['matriculados_tipo_opt_eletiva'],
            'vagas_tipo_opt_livre' => $record['vagas_tipo_opt_livre'],
            'inscritos_tipo_opt_livre' => $record['inscritos_tipo_opt_livre'],
            'matriculados_tipo_opt_livre' => $record['matriculados_tipo_opt_livre'],
            'vagas_tipo_extracurricular' => $record['vagas_tipo_extracurricular'],
            'inscritos_tipo_extracurricular' => $record['inscritos_tipo_extracurricular'],
            'matriculados_tipo_extracurricular' => $record['matriculados_tipo_extracurricular'],
            'vagas_tipo_especial' => $record['vagas_tipo_especial'],
            'inscritos_tipo_especial' => $record['inscritos_tipo_especial'],
            'matriculados_tipo_especial' => $record['matriculados_tipo_especial'],
        ];

        return $properties;
    }
}
