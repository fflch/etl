<?php

namespace Src\Loading\Scripts;

use Src\Loading\Operations\PosGraduacaoOperations;

class PosGradTables
{
    public function __construct()
    {
        $this->posGraduacaoOp = new PosGraduacaoOperations(); 
    }

    public function update()
    {
        $this->posGraduacaoOp->updateAlunosPosGraduacao();
        $this->posGraduacaoOp->updatePosGraduacoes();
    }
}