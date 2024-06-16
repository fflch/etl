<?php

namespace Src\Transformation\ReplicadoModels\CEU;

use Src\Transformation\Interfaces\Mapper;
use Src\Utils\CommonUtils;

class CursoCulturaExtensaoReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'codigo_curso_ceu' => $record['codigo_curso_ceu'],
            'sigla_unidade' => $record['sigla_unidade'],
            'codigo_departamento' => $record['codigo_departamento'],
            'nome_departamento' => $record['nome_departamento'],
            'modalidade_curso' => $record['modalidade_curso'],
            'nome_curso' => CommonUtils::cleanInput(
                $record['nome_curso'],
                ['remove_trailing_periods', 'trim_quotes']
            ),
            'tipo' => $record['tipo'],
            'codigo_colegiado' => $record['codigo_colegiado'],
            'sigla_colegiado' => $record['sigla_colegiado'],
            'area_conhecimento' => $record['area_conhecimento'],
            'area_tematica' => $record['area_tematica'],
            'linha_extensao' => $record['linha_extensao'],
        ];

        return $properties;
    }
}
