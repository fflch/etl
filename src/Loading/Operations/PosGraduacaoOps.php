<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\PosGraduacao\PosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\PosGraduacao;

class PosGraduacaoOps
{
    public function __construct()
    {
        $this->posGraduacoes = new Transformer(new PosGraduacaoReplicado, 'PosGraduacao/posgraduacoes');
    }

    public function updatePosGraduacoes()
    {
        $posGraduacoes = $this->posGraduacoes->transformData();

        // Insert placeholders limit is 65535.
        // We need 16 placeholders for each row at the moment. Let's make room for 18.
        foreach(array_chunk($posGraduacoes, 3600) as $chunk) 
        {
            //gambi para alunos com as duas últimas ocorrências simultâneas
            PosGraduacao::insert($chunk);
        }
    }
}