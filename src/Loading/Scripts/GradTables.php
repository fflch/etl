<?php

namespace Src\Loading\Scripts;

use Src\Loading\Operations\GraduacaoOperations;

class GradTables
{
    public function __construct()
    {
        $this->graduacaoOps = new GraduacaoOperations(); 
    }

    public function update()
    {
        $this->graduacaoOps->updateAlunosGraduacao();
        $this->graduacaoOps->updateGraduacoes();
        $this->graduacaoOps->updateHabilitacoes();
        $this->graduacaoOps->updateIniciacoes();
        $this->graduacaoOps->updateBolsasIC();
        $this->graduacaoOps->updateQuestionarios();
    }
}