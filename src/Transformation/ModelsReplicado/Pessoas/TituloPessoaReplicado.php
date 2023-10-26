<?php

namespace Src\Transformation\ModelsReplicado\Pessoas;

use Src\Transformation\Interfaces\Mapper;

class TituloPessoaReplicado implements Mapper
{
    public function mapping(Array $titulo)
    {
        $properties = [
            'numero_usp' => $titulo['numero_usp'],
            'nivel_titulo' => $titulo['nivel_titulo'],
            'ano_obtencao_titulo' => $titulo['ano_obtencao_titulo'],
            'descricao_titulo' => $titulo['descricao_titulo'],
            'codigo_instituicao' => $titulo['codigo_instituicao'],
            'sigla_instituicao' => $titulo['sigla_instituicao'],
            'nome_instituicao' => $titulo['nome_instituicao'],
            'codigo_curso_grad' => $titulo['codigo_curso_grad'],
            'codigo_habilitacao_grad' => $titulo['codigo_habilitacao_grad'],
            'codigo_programa_posgrad' => $titulo['codigo_programa_posgrad'],
            'codigo_area_posgrad' => $titulo['codigo_area_posgrad'],
            'ultimo_maior_titulo' => $titulo['ultimo_maior_titulo'],
        ];

        return $properties;
    }
}