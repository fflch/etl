<?php

namespace Src\Transformation\ReplicadoModels\Pessoas;

use Src\Transformation\Interfaces\Mapper;

class TituloPessoaReplicado implements Mapper
{
    public function mapping(array $record)
    {
        $properties = [
            'numero_usp' => $record['numero_usp'],
            'nivel_titulo' => $record['nivel_titulo'],
            'ano_obtencao_titulo' => $record['ano_obtencao_titulo'],
            'descricao_titulo' => $record['descricao_titulo'],
            'codigo_instituicao' => $record['codigo_instituicao'],
            'sigla_instituicao' => $record['sigla_instituicao'],
            'nome_instituicao' => $record['nome_instituicao'],
            'codigo_curso_grad' => $record['codigo_curso_grad'],
            'codigo_habilitacao_grad' => $record['codigo_habilitacao_grad'],
            'codigo_programa_posgrad' => $record['codigo_programa_posgrad'],
            'codigo_area_posgrad' => $record['codigo_area_posgrad'],
            'ultimo_maior_titulo' => $record['ultimo_maior_titulo'],
        ];

        return $properties;
    }
}
