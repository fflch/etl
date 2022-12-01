<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\PosGraduacao\AlunoPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\AlunoPosGraduacao;
use Src\Transformation\ModelsReplicado\PosGraduacao\PosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\PosGraduacao;

class PosGraduacaoOperations
{
    public function __construct()
    {
        $this->alunosPosGraduacao = new Transformer(new AlunoPosGraduacaoReplicado, 'PosGraduacao/alunos_posgraduacao');
        $this->posGraduacoes = new Transformer(new PosGraduacaoReplicado, 'PosGraduacao/posgraduacoes');
    }

    public function updateAlunosPosGraduacao()
    {
        $alunosPosGraduacao = $this->alunosPosGraduacao->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($alunosPosGraduacao, 3000) as $chunk) 
        {
            AlunoPosGraduacao::upsert($chunk, ["numeroUSP"]);
        }
    }

    public function updatePosGraduacoes()
    {
        $posGraduacoes = $this->posGraduacoes->transform();

        // Insert placeholders limit is 65535.
        // We need X placeholders for each row at the moment. Let's make room for Y.
        foreach(array_chunk($posGraduacoes, 3000) as $chunk) 
        {
            PosGraduacao::upsert($chunk, ["idPosGraduacao"]);
        }
    }
}